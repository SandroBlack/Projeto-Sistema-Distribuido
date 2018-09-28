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

	$pdo = conectar();
	$sql = "INSERT INTO usuario(nome, sexo, email, senha) VALUES(:nome, :sexo, :email, :senha)";
	$stm = $pdo->prepare($sql);
	$stm->bindValue(":nome", $nome);
	$stm->bindValue(":sexo", $sexo);
	$stm->bindValue(":email", $email);
	$stm->bindValue(":senha", $senha);
	$stm->execute();
	echo "1";
	
}