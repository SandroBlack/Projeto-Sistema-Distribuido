<?php
    session_start();
    if(!isset($_SESSION["logado"]) || $_SESSION["logado"] != true){
        header("Location:../index.html");
    }
?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <title>Pendências</title>
    </head>
    
    <body>
        <div class="container">

            <!-- TOPO -->
            <div class="row">
                <header class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
                        <a class="navbar-brand h1 text-light" href="#">Navegação</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                        <a class="nav-link text-light" href="inicio.php"><i class="fas fa-home"></i>&nbsp;Inicio<span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link text-light" href="arquivos.php"><i class="fas fa-file-alt"></i>&nbsp;Arquivos<span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="email.php"><i class="fas fa-envelope-square"></i>&nbsp;E-mail&nbsp;<span class="badge badge-primary contEmail"><?=$_SESSION["qtdEmails"]?></span><span class="sr-only">(current)</span></a>
                                </li>                                                                
                                <li class="nav-item active">
                                    <a class="nav-link text-light" href="pendencias.php"><span class=""><i class="fas fa-exclamation-triangle"></i></span>&nbsp;Pendências&nbsp;<span class="badge badge-primary">0</span><span class="sr-only">(current)</span></a>
                                </li>                                                                
                                                                                                
                            </ul>
                        </div>
                        <span class="text-light mr-5"><?=$_SESSION["nomeUsuario"]?></span>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle fa-1x"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" type="button"><i class="fas fa-key"></i>&nbsp;Alterar Senha</button>
                                <button type="button" class="dropdown-item" id="btnMenuSair"><i class="fas fa-sign-out-alt"></i>&nbsp;Sair</button>                          
                            </div>
                        </div>   
                    </nav>                                 
                </header>                
            </div> <!-- FIM TOPO -->

            <!-- BREADCRUMB -->
            <div class="row">            
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="arquivos.php">Arquivos</a></li>
                        <li class="breadcrumb-item"><a href="email.php">E-mail</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pendências</li>
                    </ol>                    
                </div>
            </div> 

            <!-- CONTEÚDO -->
            <div class="row">            
                <div class="col-md-12">
                    <h3 class="text-dark"><i class="fas fa-exclamation-triangle"></i>&nbsp;Pendências</h3>
                    <hr> 
                    <table class="table table-bordered table-sm table-responsive-sm text-center">
                        <thead class="text-dark text-dark bg-light">
                            <tr>
                                <th scope="col">Nº</th>
                                <th scope="col">Título</th>
                                <th scope="col">Data</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Data limite</th>
                                <th scope="col">Situação</th>
                                <th scope="col">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-dark" scope="row">1</th>
                                <td>Requisição 01</td>
                                <td>01/08/2018</td>
                                <td>Pendência 01</td>
                                <td>05/08/2018</td>
                                <td>Pendente</td>
                                <td><button type="button" class="btn btn-primary btn-sm" id="reselverPendencia">Resolver</button></td>
                            </tr>              
                        </tbody>
                    </table>                    
                </div>
            </div> <!-- FIM CONTEÚDO -->                       

        </div>



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="../js/funcoes.js"></script>
    </body>    
</html>