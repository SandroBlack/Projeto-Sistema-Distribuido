<?php 
include_once("conexao.php");
cadastro();
    function cadastro(){ 
		
		session_start();
       

		$NOME = $_POST["nome"];
		
		$EMAIL = $_POST["email"];
		
		$SENHA = $_POST["Password"];
		$SEXO = $_POST["M,F"];

		
		try
		{
			$pdo = conectar();	
			
			$sql = "INSERT INTO users(NOME, EMAIL,SENHA,SEXO) VALUES(:NOME, :EMAIL, :SENHA,:SEXO)";
				
			$inserir = $pdo->prepare($sql);
				
			$inserir->bindValue(":NOME", $NOME);
				
			$inserir->bindValue(":EMAIL", $EMAIL);
				
			$inserir->bindValue(":SENHA", $SENHA);

			$inserir->bindValue(":SEXO",$SEXO);
		
			
				
			$inserir->execute();
			
			
			
		} 
        
				
		catch(PDOException $e)
		{
			$sucess = "0";
	
			echo $sucess;
		
			return 0;
		}
		 session_destroy();	
 
	 return 0;   
	
	}
    ?>
