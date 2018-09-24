<?php
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
    $email = $_POST["dados"]."email";   
    $senha = $_POST["dados"]."senha";
    
    echo "chegou na função!";    
    
    
}

function cadastrar(){
	
	$dados;
	$nome;
	$email;
	$senha;
	
	if ( !isset( $_POST["dados"] ) ){
		
		echo "falha";
		
		return 0;
		
	}
		
	parse_str( $_POST["dados"], $dados );
			
	if ( empty( $dados["nomeCadastro"] ) || empty( $dados["emailCadastro"] ) || empty( $dados["senhaCadastro"] ) || empty( $dados["reSenhaCadastro"] ) ) {
		
		echo "falha";
		
		return 0;
		
	} else if ( $dados["senhaCadastro"] != $dados["reSenhaCadastro"] ) {
		
		echo "falha";
		
		return 0;
		
	}
	
	$nome 	= $dados["nomeCadastro"];
	$email 	= $dados["emailCadastro"];	
	$options = [
		'cost' => 12,
	];	
	$senha = password_hash($dados["senhaCadastro"], PASSWORD_BCRYPT, $options);
	
};
