<?php
	
	include_once("dbConexao.php");
	if(!isset($_SESSION)){
		session_start();
	//session_destroy();
	//header("Location:../index.html");	
}

/* DIRECIONAMENTO DAS FUNÇÕES */
@$funcao = $_POST["funcao"];
switch($funcao){
    case "login":
        login();
		break;
	case "sair":
		sair();
		break;	
	case "cadastro":
		cadastrar();
		break;
	case "consultaEmailRecebido":
		consultaEmailRecebido();
		break;
	case "consultaEmailEnviado":
		consultaEmailEnviado();
		break;	
	case "enviarEmail":
		enviarEmail();
		break;
	case "lerEmail":
		lerEmail();
		break;
	case "contarEmailNaoLido":
		contarEmailNaoLido();
		break;			
	case "pesquisarUser":
		pesquisarUser();
		break;
}


/* PÁGINA DE INDEX */

// Função de Login
function login(){	
	parse_str($_POST["dados"], $dados);
	$email = $dados["email"];
	$senha = $dados["senha"];	
	
	if(empty($email) || empty($senha)){
		echo "0";
		return 0;
	}	

	try{
		$pdo = conectar();
		$sql = "SELECT pk_usuario, nome, email, senha, situacao FROM usuario WHERE email = :email";
		$stm = $pdo->prepare($sql);
		$stm->bindValue(":email", $email); 	 
		$stm->execute();
		$dados = $stm->fetch(PDO::FETCH_ASSOC);
		
		if ($stm->rowCount() == 1){									
			if($dados["situacao"] == 0){
				echo "Inativo";
				return 0;
			} else if(password_verify($senha, $dados["senha"])){	
				$_SESSION["logado"] = true;
				$_SESSION["idUsuario"] = $dados["pk_usuario"]; 
				$_SESSION["nomeUsuario"] = $dados["nome"]; 
				echo "1";
				return 0;
			} else{
				echo "2";
				return 0;
			}			 
		} else{	
			echo "3";
			return 0;
		}
	} catch(PDOException $erro){
		echo "Erro: " . $erro->getMessage() . "<br>";
	}
}

// Sair e Destruir a Sessão
function sair(){
	if(isset($_SESSION["logado"])){
		session_destroy();
	}
}

// Consulta Cadastro
function consultaCadastro($email){
	try{
		$pdo = conectar();
		$sql = "SELECT email FROM usuario WHERE email = :email";
		$stm = $pdo->prepare($sql);
		$stm->bindValue(":email", $email); 	 
		$stm->execute();
		$dados = $stm->fetch(PDO::FETCH_ASSOC);
		
		if ($stm->rowCount() == 1){									
			return true;	 
		} else{	
			return false;
		}
	} catch(PDOException $erro){
		echo "Erro: " . $erro->getMessage() . "<br>";
	}
}

// Função de Cadastro de Usuário
function cadastrar(){	
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
	$situacao = true; // Depois que a função de envio de e-mail de confirmação estiver pronta, essa linha deve ser removida.	
	
	if (empty($nome) || empty($sexo) || empty($email) || empty($senha) || empty($reSenha)){
		
		echo "falha2";
		
		return 0;
		
	} else if ($senha != $reSenha){
		
		echo "falha3";
		
		return 0;		
	}
	if(consultaCadastro($email)){
		echo "cadastrado";
		return 0;
	}

	$options = [
		'cost' => 12,
	];	
	$senha = password_hash($dados["senhaCadastro"], PASSWORD_BCRYPT, $options);

	try{
		$pdo = conectar();
		$sql = "INSERT INTO usuario(nome, sexo, email, senha, situacao) VALUES(:nome, :sexo, :email, :senha, :situacao)";
		$stm = $pdo->prepare($sql);
		$stm->bindValue(":nome", $nome);
		$stm->bindValue(":sexo", $sexo);
		$stm->bindValue(":email", $email);
		$stm->bindValue(":senha", $senha);
		$stm->bindValue(":situacao", $situacao);
		$stm->execute();
		echo "1";		
		//confirmarCadastro($nome, $email);
		
	} catch(PDOException $erro){
		echo "Erro: " . $erro->getMessage() . "<br>";
	}
}

/* ENVIO DE EMAILS */

// Pesquisar Usuários Cadastrados
function pesquisarUser(){
	$texto  = $_POST["texto"];
	
	try{
		$pdo = conectar();
		$sql = "SELECT pk_usuario, nome FROM usuario WHERE nome LIKE '$texto%'";
		$stm = $pdo->prepare($sql);
		//$stm->bindValue(":nome", $texto);
		$stm->execute();
		$dados = $stm->fetch(PDO::FETCH_ASSOC);
		echo json_encode($dados);
		
	} catch(PDOException $erro){
		echo "Erro: " . $erro->getMessage() . "<br>";
	}
}

// Relacionar E-mails
function consultaEmailRecebido(){
	@$idUsuario = $_SESSION["idUsuario"];

	try{
		$pdo = conectar();
		$sql = "SELECT a.nome, c.pk_email, c.assunto, b.data_mensagem, b.situacao 
				FROM usuario a				 
				INNER JOIN mensagem b ON b.FK_USUARIO_MENSAGEM = a.pk_usuario
				INNER JOIN email c ON c.PK_EMAIL = b.FK_EMAIL_MENSAGEM
				WHERE c.FK_USUARIO_EMAIL_PARA = :idUsuario";				
		$stm = $pdo->prepare($sql);
		$stm->bindValue(":idUsuario", $idUsuario);		
		$stm->execute();
		$dados = $stm->fetchAll(PDO::FETCH_ASSOC);				
		echo json_encode($dados);			
		
	} catch(PDOException $erro){
		echo "Erro: " . $erro->getMessage() . "<br>";
	}
}

function consultaEmailEnviado(){
	try{
		$pdo = conectar();
		$sql = "SELECT a.nome, b.pk_email, b.assunto, c.data_mensagem 
				FROM usuario a
				INNER JOIN email b ON a.pk_usuario = b.fk_usuario_email_para
				INNER JOIN mensagem c ON c.fk_email_mensagem = b.pk_email 
				WHERE b.fk_usuario_email_de = :de";
		$stm = $pdo->prepare($sql);
		$stm->bindValue(":de", $_SESSION["idUsuario"]);		
		$stm->execute();
		$dados = $stm->fetchAll(PDO::FETCH_ASSOC);			
		echo json_encode($dados);
		
	} catch(PDOException $erro){
		echo "Erro: " . $erro->getMessage() . "<br>";
	}
}

// Contar Emails não Lidos
function contarEmailNaoLido(){
	$idUsuario = $_SESSION["idUsuario"];
	
	try{
		$pdo = conectar();
		$sql = "SELECT COUNT(conteudo) AS qtd
				FROM mensagem 
				WHERE situacao = 0
				AND fk_usuario_mensagem = $idUsuario";				
		$stm = $pdo->prepare($sql);				
		$stm->execute();
		$dados = $stm->fetch(PDO::FETCH_ASSOC);
		$_SESSION["qtdEmails"] = $dados["qtd"];		
		
	} catch(PDOException $erro){
		echo "Erro: " . $erro->getMessage() . "<br>";
	}
}

// Enviar E-mail
function enviarEmail(){	
	$acao = $_POST["acao"];
	
	if($acao == "novoEmail"){
		parse_str($_POST["dados"], $dados);
		$de = intval($_SESSION["idUsuario"]);	
		$para = intval($dados["novoEmailPara"]);
		$assunto = $dados["novoEmailAssunto"];
		$mensagem = $dados["novoEmailMensagem"];		
		
		try{
			$pdo = conectar();
			$sql = "INSERT INTO email(assunto, fk_usuario_email_de, fk_usuario_email_para) VALUES(:assunto, :de, :para)";
			$stm = $pdo->prepare($sql);
			$stm->bindValue(":assunto", $assunto);
			$stm->bindValue(":de", $de);
			$stm->bindValue(":para", $para);
			$stm->execute();
			$idEmail = $pdo->lastInsertId();	
			conteudoEmail($de, $idEmail, $mensagem);
						
		} catch(PDOException $erro){
			echo "Erro: " . $erro->getMessage() . "<br>";
		}
		
	} else if($acao == "resposta"){
		$idEmail = intval($_POST["idResposta"]); // Tem pegar o id da mensagem clicada e respondida.
		$mensagem = $_POST["mensagem"];
		$de = $_SESSION["idUsuario"];
		
		try{
			$pdo = conectar();
			$sql = "SELECT assunto, fk_usuario_email_de FROM email WHERE pk_email = :idEmail";
			$stm = $pdo->prepare($sql);
			$stm->bindValue(":idEmail", $idEmail);			
			$stm->execute();			
			$dados = $stm->fetch(PDO::FETCH_ASSOC);			
			$assunto = "Re: " . $dados["assunto"];
			$para = intval($dados["fk_usuario_email_de"]);
							
			$sql2 = "INSERT INTO email(assunto, fk_usuario_email_de, fk_usuario_email_para) VALUES(:assunto, :de, :para)";
			$stm2 = $pdo->prepare($sql2);
			$stm2->bindValue(":assunto", $assunto);
			$stm2->bindValue(":de", $de);
			$stm2->bindValue(":para", $para);
			$stm2->execute();
			$idEmail2 = $pdo->lastInsertId();			
			conteudoEmail($de, $idEmail2, $mensagem);
			
		} catch(PDOException $erro){
			echo "Erro: " . $erro->getMessage() . "<br>";
		}
	}
}

// Mensagem
function conteudoEmail($de, $para, $mensagem){	
		
	try{
		$pdo = conectar();
		$sql = "INSERT INTO mensagem(conteudo, fk_email_mensagem, fk_usuario_mensagem) VALUES(:conteudo, :idEmail, :de)";
		$stm = $pdo->prepare($sql);
		$stm->bindValue(":conteudo", $mensagem);
		$stm->bindValue(":de", $de);
		$stm->bindValue(":idEmail", $para);
		$stm->execute();		
		echo "1";

	} catch(PDOException $erro){
		echo "Erro: " . $erro->getMessage() . "<br>";
	}
}

// Leitura de E-mails
function lerEmail(){
	if($_POST["acao"] == "recebido"){
		$sql = "SELECT a.nome, c.assunto, b.conteudo, b.data_mensagem, b.situacao 
				FROM usuario a				 
				INNER JOIN mensagem b ON b.FK_USUARIO_MENSAGEM = a.pk_usuario
				INNER JOIN email c ON c.PK_EMAIL = b.FK_EMAIL_MENSAGEM
				WHERE c.FK_USUARIO_EMAIL_PARA = :quem";
	} else{
		$sql = "SELECT a.nome, c.assunto, b.conteudo, b.data_mensagem, b.situacao 
				FROM usuario a				 
				INNER JOIN mensagem b ON b.FK_USUARIO_MENSAGEM = a.pk_usuario
				INNER JOIN email c ON c.PK_EMAIL = b.FK_EMAIL_MENSAGEM
				WHERE c.FK_USUARIO_EMAIL_DE = :quem";
	}

	try{
		$pdo = conectar();		
		$stm = $pdo->prepare($sql);
		$stm->bindValue(":quem", $_SESSION["idUsuario"]);		
		$stm->execute();
		$dados = $stm->fetch(PDO::FETCH_ASSOC);	
		echo json_encode($dados);	
		//echo "1";			

	} catch(PDOException $erro){
		echo "Erro: " . $erro->getMessage() . "<br>";
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
                    	<a href=http://projeto-sistemas-distribuidos.herokuapp.com/validaCadastro.php align='center'>Clique Aqui para Validar seu Cadastro</a>
                	</div>
            	</div>" . "\r\n";

   $headers = 'MIME-Version: 1.1' . "\r\n";
   $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
   $headers .= 'From: Contato Sandroteck<contato@sandroteck.com.br>' . "\r\n";
   $headers .= 'To: '.$nome.' <'.$email.'>' . "\r\n";
   $headers .= 'Reply-To: <contato@sandroteck.com.br>' . "\r\n";

   if(mail($para, $assunto, $mensagem, $headers)){   	
   	echo "1";
    
   } else{
    echo "2";
   }
}

// Recuperar Senha
function emailRecuperaSenha() {
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
    } catch (Exception $erro) {
        echo "Erro: " . $erro->getMessage() . "<br>";
    }
}