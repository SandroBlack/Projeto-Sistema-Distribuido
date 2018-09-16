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
    $email = $_POST["dados"][0]["value"];
    $senha = $_POST["dados"][1]["value"];
    echo "chegou na função!";    
    
    
}
