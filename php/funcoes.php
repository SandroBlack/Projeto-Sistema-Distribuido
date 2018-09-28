<?php
include_once("dbConexao.php");
if(!isset($_SESSION)){
    session_start();
}

/* DIRECIONAMENTO DAS FUNÇÕES */
$funcao = $_POST["funcao"];
switch($funcao){
    case "login":
        login();
        break;
	case "cadastro":
		cadastrar();
		break;
	case "consultaEmail":
		consultaEmail();
		break;
	case "enviarEmail":
		enviarEmail();
		break;
	case "pesquisarUser":
		pesquisarUser();
		break;
}


/* PÁGINA DE INDEX */

// Função de Login
function login(){
	//$dados;
	parse_str($_POST["dados"], $dados);
	$email = $dados["email"];
	$senha = $dados["senha"];    
	
	if(empty($email) || empty($senha)){
		echo "0";
		return 0;
	}	

	try{
		$pdo = conectar();
		$sql = "SELECT email, senha, situacao FROM usuario WHERE email = :email";
		$stm = $pdo->prepare($sql);
		$stm->bindValue(":email", $email); 	 
		$stm->execute();
		$dados = $stm->fetch(PDO::FETCH_ASSOC);
		
		if ($stm->rowCount() == 1){
			if(password_verify($senha, $dados["senha"])){		
				if($dados["situacao"] == 0){
					echo "Inativo";
					return 0;
				} else{
					$_SESSION["nomeUsuario"] = $dados["nome"]; 
					echo "1";
					return 0;
				}
			} else{
				echo "2";
				return 0;
			}
		} else{	
			echo "2";
			return 0;
		}
	} catch(){
		echo "Erro: " . $ex->getMessage() . "<br>";
	}	
}

// Função de Cadastro de Usuário
function cadastrar(){
	//var_dump($_POST["dados"]);
	if ( !isset( $_POST["dados"] ) ){
		
		echo "falha";
		
		return 0;
		
	} 

	parse_str( $_POST["dados"], $dados );	
	$nome    = $dados["nomeCadastro"];
	$sexo    = $dados["radioSexo"];
	$email   = $dados["emailCadastro"];
	$senha   = $dados["senhaCadastro"];	
	$reSenha = $dados["reSenhaCadastro"];	
		
	if (empty($nome) || empty($sexo) || empty($email) || empty($senha) || empty($reSenha)){
		
		echo "falha2";
		
		return 0;
		
	} else if ($senha != $reSenha){
		
		echo "falha3";
		
		return 0;
		
	}
	
	$options = [
		'cost' => 12,
	];	
	$senha = password_hash($dados["senhaCadastro"], PASSWORD_BCRYPT, $options);

	try{
		$pdo = conectar();
		$sql = "INSERT INTO usuario(nome, sexo, email, senha) VALUES(:nome, :sexo, :email, :senha)";
		$stm = $pdo->prepare($sql);
		$stm->bindValue(":nome", $nome);
		$stm->bindValue(":sexo", $sexo);
		$stm->bindValue(":email", $email);
		$stm->bindValue(":senha", $senha);
		$stm->execute();
		echo "1";
		confirmarCadastro($nome, $email);
	
	} catch(PDOException $erro){
		echo "Erro: " . $ex->getMessage() . "<br>";
	}
}

/* ENVIO DE EMAILS */

// Pesquisar Usuário
function pesquisarUser(){
	$texto  = $_POST["texto"];
	
	try{
		$pdo = conectar();
		$sql = "SELECT nome FROM usuario WHERE nome like ':nome%'";
		$stm = $pdo->prepare($sql);
		$stm->bindValue(":nome", $texto);
		$stm->execute();
		$dados = $stm->fetch(PDO::FETCH_ASSOC);
		echo json_encode($dados);
		
	} catch(){
		
	}
}

// Relacionar E-mails
function consultaEmail(){
	try{
		$sql = "SELECT * FROM email where fk_email_usuario_para = :usuario";
		$stm = $pdo->prepare($sql);
		$stm->bindValue(":usuario", $_SESSION["nomeUsuario"]);		
		$stm->execute();
		$dados = $stm->fetch(PDO::FETCH_ASSOC);
		echo json_encode($dados);
	} catch(PDOException $erro){
		echo "Erro: " . $ex->getMessage() . "<br>";
	}
}

// Enviar E-mail
function enviarEmail(){	
	$acao = $_POST["acao"];
	
	if($acao == "novoEmail"){
		parse_str($_POST["dados"], $dados);
		$de = $_SESSION["nomeUsuario"];	
		$para = $dados["novoEmailPara"];
		$assunto = $dados["novoEmailAssunto"];
		$mensagem = $dados["novoEmailMensagem"];
			
		try{
			$pdo = conectar();
			$sql = "INSERT INTO email VALUES(:assunto, :de, :para)";
			$stm = $pdo->prepare($sql);
			$stm->bindValue(":assunto", $assunto);
			$stm->bindValue(":de",$de);
			$stm->bindValue(":para", $para);
			$stm->execute();
			$idEmail = last_insert_id();	
			conteudoEmail($para, $mensagem, $idEmail);
			echo "1";
			
		} catch(PDOException $erro){
			echo "Erro: " . $ex->getMessage() . "<br>";
		}
		
	} else if($acao == "resposta"){
		$idEmail = $_POST["?"]; // Tem pegar o id da mensagem clicada e respondida.
		$mensagem = $_POST["mensagem"];
		$de = $_SESSION["nomeUsuario"];
		
		try{
			$pdo = conectar();
			$sql = "SELECT assunto, fk_usuario_mensagem FROM email WHERE pk_email = :idEmail)";
			$stm = $pdo->prepare($sql);
			$stm->bindValue(":idEmail", $idEmail);			
			$stm->execute();			
			$dados = $stm->fetch(PDO::FETCH_ASSOC);			
			$assunto = $dados["assunto"];
			$para = $dados["fk_usuario_mensagem"];
						
			$sql2 = "INSERT INTO email VALUES(:assunto, :de, :para)";
			$stm2 = $pdo->prepare($sql);
			$stm2->bindValue(":assunto", $assunto);
			$stm2->bindValue(":de",$de);
			$stm2->bindValue(":para", $para);
			$stm2->execute();			
			conteudoEmail($de, $mensagem, $idEmail);
			
		} catch(PDOException $erro){
			echo "Erro: " . $ex->getMessage() . "<br>";
		}		
	}
}

// Mensagem
function conteudoEmail($de, $mensagem, $idEmail){	
		
	try{
		$sql = "INSERT INTO mensagem VALUES(:conteudo, :de) WHERE fk_email_mensagem = :idEmail";
		$stm = $pdo->prepare($sql);
		$stm->bindValue(":conteudo", $mensagem);
		$stm->bindValue(":idEmail", $idEmail);
		$stm->bindValue(":de", $de);
		$stm->execute();
	} catch(PDOException $erro){
		echo "Erro: " . $ex->getMessage() . "<br>";
	}
}

// Confirmar Cadastro
function confirmarCadastro($nome, $email) {
    	
    $para = $email;
    $assunto = "Confirmação de Cadastro";
    $mensagem = "<div style='width: 100%; height: 600px; background: #eee;'>

		<div style='width: 600px; height: 500px; background: #fff; margin: 20px auto;'>
                    	<h2 align='center'>Validação de Cadastro</h2>
                    <br><br><br>
                    	<a href=https://sandroteck.000webhostapp.com/index.html>Clique Aqui para Validar seu Cadastro</a>

                </div>

            </div>" . "\r\n";

   $headers = 'MIME-Version: 1.1' . "\r\n";
   $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
   $headers .= 'From: Contato Sandroteck<contato@sandroteck.com.br>' . "\r\n";

   $headers .= 'To: '.$nome.' <'.$email.'>' . "\r\n";

   $headers .= 'Reply-To: <contato@sandroteck.com.br>' . "\r\n";


   if(mail($para, $assunto, $mensagem, $headers)){    	
   	
    echo "1";
    
   }else{
    echo "2";
   }
}

// Recuperar Senha
function emailRecuperaSenha() {
    $email = $_POST["email"];
	
    $para = $_POST["email"];
    $assunto = "Redefinição de Senha";

    $corpo = "<b>Mensagem de Contato</b><br><br>";
    $corpo .= "<b>Nome: </b> $nome";
    $corpo .= "<br><b>Email: </b> $email";

    $header = "Content-Type: text-html; charset= utf-8\n";
    $header .= "From: $email Reply-to: $email\n";
    try {
        @mail($para, $assunto, $corpo, $header);
        echo "<script>alert('Sua Mensagem foi Enviada com Sucesso!')</script>";
        echo "<script>location.href='http://www.sandroteck.zz.vc/?pagina=recuperarSenha'</script>";
    } catch (Exception $ex) {
        echo "Erro: " . $ex->getMessage() . "<br>";
    }
}


















