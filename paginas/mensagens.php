<?php
    if(!isset($_SESSION)){
        session_start();
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

    <title>Mensagens</title>
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
                                    <a class="nav-link text-light" href="inicio.html">Inicio<span class="sr-only">(current)</span></a>
                                </li>                                                                
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="arquivos.html">Arquivos<span class="sr-only">(current)</span></a>
                                </li>                                                                
                                <li class="nav-item active">
                                    <a class="nav-link text-light" href="#"><i class="far fa-comments"></i>&nbsp;Mensagens&nbsp;<span class="badge badge-primary"><?=$_SESSION["qtdEmails"]?></span><span class="sr-only">(current)</span></a>
                                </li>                                                                
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="pendencias.html">Pendências&nbsp;<span class="badge badge-primary">0</span><span class="sr-only">(current)</span></a>
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
                                <button type="button" class="dropdown-item" id="btnMenuSair">Sair</button>                         
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
                        <li class="breadcrumb-item active" aria-current="page">Mensagens</li>
                    </ol>                    
                </div>
            </div>   

            <!-- CONTEÚDO -->
            <div class="row">                            
                <div class="col-md-12">
                    <h3 class="d-inline"><i class="far fa-comments"></i>&nbsp;Mensagens</h3>                    
                    <hr>
                </div>     
            </div>        
            <div class="row">            
                                 
                    <div class="col-md-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                          <input type="text" class="form-control mb-3" placeholder="Selecionar usuário">
                          <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Usuário X</a>

                        </div>
                    </div>

                    <div class="col-md-9">                        
                        <div class="tab-content" id="v-pills-tabContent">
                          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <form>
                                <div class="form-group">
                                  <label for="exampleInputMensagem">Mensagem</label>
                                  <textarea style="resize:none" class="form-control" id="textareaMensagem" aria-describedby="mensagemlHelp" placeholder="Mensagem" rows="15" readonly></textarea>                                  
                                </div>                                
                                <div class="form-group">                                    
                                    <input type="text" class="form-control" id="inputMensagem" aria-describedby="mensagemlHelp" placeholder="Digite uma mensagem">                              
                                  </div>
                                <button type="submit" class="btn btn-primary" id="btnEnviarMensagem">Enviar</button>
                              </form>
                          </div>                                           
                        </div>
                    </div>
                
            </div> <!-- FIM DO CONTEÚDO --> 
        </div>



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="../js/funcoes.js"></script>
    </body>    
</html>