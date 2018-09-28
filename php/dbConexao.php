<?php

function conectar(){
	$host = "localhost";
	$banco = "projeto_sistema_dist";
	$usr = "root";
	$pwd = "";
	try{
		$conn = new PDO("mysql:host=".$host. ";dbname=" .$banco, $usr, $pwd);
		$conn->exec("SET names utf8");
		//return array("conexao"=>$conn, "mensagem"=>"sucesso");
	} catch(PDOException $e) {
		return array("conexao"=> null, "mensagem"=>"Ocorreu um o seguinte erro:<br>". $e -> getMessage());
	}
	return $conn;
}

?>