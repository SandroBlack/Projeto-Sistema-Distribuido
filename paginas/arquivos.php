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

    <title>Arquivos</title>
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
                                <li class="nav-item active">
                                    <a class="nav-link text-light" href="arquivos.php"><i class="fas fa-file-alt"></i>&nbsp;Arquivos<span class="sr-only">(current)</span></a>
                                </li>                                                                
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="email.php"><i class="fas fa-envelope-square"></i>&nbsp;E-mail&nbsp;<span class="badge badge-primary contEmail"><?=$_SESSION["qtdEmails"]?></span><span class="sr-only">(current)</span></a>
                                </li>                                                                
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="pendencias.php"><i class="fas fa-exclamation-triangle"></i>&nbsp;Pendências&nbsp;<span class="badge badge-primary">0</span><span class="sr-only">(current)</span></a>
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
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">                            
                                <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Arquivos</li>
                        </ol>
                    </nav>                
                </div>
            </div> 

            <!-- CONTEÚDO -->
            <div class="row">     
                <div class="col-md-12">
                    <h3 class="d-inline text-dark"><i class="fas fa-file-alt"></i>&nbsp;Arquivos</h3>         
                    <button class="btn btn-primary float-right mr-3" type="button" data-toggle="modal" data-target="#modalNovaRequisicao"><i class="fas fa-plus-circle"></i>&nbsp;Nova</button><hr> 

                    <!-- Abas -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Minhas Requisições</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Requisições Aceitas</a>
                        </li>                            
                    </ul> 
                     
                    <!-- Conteúdo das Abas -->
                    <div class="tab-content" id="myTabContent">                                      
        
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <table class="table table-sm table-hover text-center tblEmailEntrada" id="tblCaixaEntrada">
                                <thead>
                                    <tr class="text-dark bg-light">
                                            <th scope="col">Data</th>                                            
                                            <th scope="col">Descrição</th>
                                            <th scope="col">Extenção</th>
                                            <th scope="col">Prazo</th>                                           
                                            <th scope="col">Situação</th>                                           
                                        </tr>
                                    </thead>
                                    <tbody>                               
                                        <!--<tr class="text-primary" data-target="#modalLerEmail" data-toggle="modal" style="cursor:pointer" id="XXX">
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Assunto Recebido 01</td>
                                            <td>22/08/2018</td>
                                        </tr>-->
                                        
                                </tbody>    
                            </table>
                        </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">  
                            <table class="table table-sm table-hover text-center tblEmailEntrada" id="tblCaixaEntrada">
                                <thead>
                                <tr class="text-dark bg-light">
                                        <th scope="col">Data</th>
                                        <th scope="col">Usuário</th>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Prazo</th>
                                        <th scope="col">Situação</th>
                                    </tr>
                                </thead>
                                <tbody>                               
                                    <!--<tr class="text-primary" data-target="#modalLerEmail" data-toggle="modal" style="cursor:pointer" id="XXX">
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Assunto Recebido 01</td>
                                        <td>22/08/2018</td>
                                    </tr>-->
                                    
                                </tbody>    
                            </table>                
                        </div> 

                    </div> <!-- Fim Conteúdo das Abas -->
                </div>                 

            </div> <!-- FIM CONTEÚDO -->  

            <!-- Modal Nova Requisição -->
            <div class="modal fade" id="modalNovaRequisicao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><span class="text-primary"><i class="fas fa-file-alt"></i></span>&nbsp;Nova Requisição de Arquivo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           
                        <small id="emailHelp" class="form-text text-muted">Escolha o usuário, extensão, tamanho maxímo e o prazo de entrega do arquivo.</small><hr>  
                        <form class="" id="formRequisitar">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Usuário</label>
                                <input type="search" class="form-control" id="pesquisaUsuarioArquivo" placeholder="Pesquisar usuário" required>   
                            </div>
                            <div class="form-group">
                                <label for="descricaoArquivo">Descrição</label>
                                <textarea type="text" class="form-control" id="descricaoArquivo" placeholder="Descrição" style="resize:none" required></textarea>   
                            </div>    
                            <label for="exampleInputEmail1">Extensão do Arquivo</label>
                            <select class="form-control mb-3" id="selectFormato">
                                <option>Selecione</option>
                                <option>.DOCX</option>
                                <option>.JPEG</option>
                                <option>.PDF</option>
                                <option>.TXT</option>
                                <option>.XLSX</option>
                            </select>
                            
                            <div class="form-group">
                                <label for="exampleInputTamanho">Tamanho Maxímo do Arquivo</label><br>                       
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio1mb" value="1mb">
                                    <label class="form-check-label" for="inlineRadio1">1 MB</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio3mb" value="3mb">
                                    <label class="form-check-label" for="inlineRadio1">3 MB</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio5mb" value="5mb">
                                    <label class="form-check-label" for="inlineRadio1">5 MB</label>
                                </div>
                                <div class="form-check form-check-inline mb-3">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio5mb" value="5mb">
                                    <label class="form-check-label" for="inlineRadio1">10 MB</label>
                                </div>
                                <div class="form-group">
                                <label for="prazo">Prazo para Entraga</label>
                                    <input class="form-control" name="prazo" id="prazo" type="date">
                                </div>
                                <hr>                                
                            </div>
                        </form>
                                      
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button> -->
                            <button type="button" class="btn btn-primary mt-3" id="btnRequisitar"><i class="fas fa-exchange-alt"></i>&nbsp;Requisitar</button>
                        </div>
                            
                    </div>
                </div>
            </div> <!-- Fim Modal Nova Requisição -->

        </div> <!-- Fim Container -->



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="../js/funcoes.js"></script>
    </body>    
</html>