<?php

function conectar(){
	//conexão localhost
	$host = "localhost";
	$banco = "projeto_sistema_dist";
	$usr = "root";
	$pwd = "";
	
	// Conexão Heroku
	/*$host = "ec2-174-129-18-98.compute-1.amazonaws.com";
	$banco = "de5vh30tv8uv76";
	$usr = "lenriksyouqcls";
	$pwd = "bdfedd1a65546befe6d385202f0440e735b31f6f9ca6cd684c3899c97aefefeb";*/
	
	try{
		$conn = new PDO("mysql:host=".$host. ";dbname=" .$banco, $usr, $pwd); //<- Mysql
		//$conn = new PDO("pgsql:host=".$host. ";dbname=" .$banco, $usr, $pwd); // <- Postegre
		$conn->exec("SET names utf8");
		//return array("conexao"=>$conn, "mensagem"=>"sucesso");
	} catch(PDOException $e) {
		return array("conexao"=> null, "mensagem"=>"Ocorreu um o seguinte erro:<br>". $e -> getMessage());
	}
	return $conn;
}

?>