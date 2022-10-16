<?php

function conectar(){
	//conexão localhost
	/*$host = "localhost";
	$banco = "projeto_sistema_dist";
	$usr = "root";
	$pwd = "";*/
	
	// Conexão Heroku
	$host = "ec2-18-235-76-106.compute-1.amazonaws.com";
	$banco = "d5vcfecbt898jg";
	$usr = "ojnwzceniwjvuf";
	$pwd = "e6678550b8956d38de9371000772f90e75811136efacb79e05fa99e2907b55f7";
	
	try{
		//$conn = new PDO("mysql:host=".$host. ";dbname=" .$banco, $usr, $pwd); //<- Mysql Localhost
		$conn = new PDO("pgsql:host=".$host. ";dbname=" .$banco, $usr, $pwd); // <- Postegre Heroku
		$conn->exec("SET names utf8");
		//return array("conexao"=>$conn, "mensagem"=>"sucesso");
	} catch(PDOException $e) {
		return array("conexao"=> null, "mensagem"=>"Ocorreu um o seguinte erro:<br>". $e -> getMessage());
	}
	return $conn;
}

?>
