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
}


/* PÁGINA DE INDEX */

// Função de Login
function login(){
    $email = $_POST["dados"]."email";   
    $senha = $_POST["dados"]."senha";
    
    echo "chegou na função!";    
    
    
}
