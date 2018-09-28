<?php
	if(!isset($_SESSION)){
    session_start();
}


<!doctype html>
<html lang="br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <title>E-mail</title>
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
                                <li class="nav-item active">
                                    <a class="nav-link text-light" href="email.php"><i class="fas fa-envelope-square"></i>&nbsp;E-mail&nbsp;<span class="badge badge-primary contEmail">0</span><span class="sr-only">(current)</span></a>
                                </li>                                                                
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="pendencias.php"><i class="fas fa-exclamation-triangle"></i>&nbsp;Pendências&nbsp;<span class="badge badge-primary">0</span><span class="sr-only">(current)</span></a>
                                </li>                                                                
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle fa-1x"></i>  
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button type="button" class="dropdown-item" id="btnAltSenha"><i class="fas fa-key"></i>&nbsp;Alterar Senha</button>
                                <button type="button" class="dropdown-item" id="btnMenuSair"><i class="fas fa-sign-out-alt"></i>&nbsp;Sair</button>                        
                            </div>
                        </div>   
                    </nav>                                 
                </header>                
            </div> 
            
            <!-- BREADCRUMB -->
            <div class="row">            
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio.html">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="arquivos.html">Arquivos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">E-mail</li>
                    </ol>                    
                </div>
            </div>   

            <!-- CONTEÚDO -->
            <div class="row">            
                <div class="col-md-12">
                    <h3 class="d-inline text-dark"><i class="fas fa-envelope-square"></i>&nbsp;E-mail</h3>
                    <button class="btn btn-primary float-right mr-3" type="button" data-toggle="modal" data-target="#modalNovoEmail"><i class="fas fa-edit"></i>&nbsp;Novo</button>
                    <hr> 
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Caixa de Entrada</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Enviadas</a>
                            </li>                            
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"> 
                            
                            <!-- Caixa de Entrada -->
                            <table class="table table-sm table-hover text-center tblEmailEntrada" id="tblCaixaEntrada">
                                <thead>
                                    <tr class="text-dark bg-light">
                                        <th scope="col">Nº</th>
                                        <th scope="col">Remetente</th>
                                        <th scope="col">Assunto</th>
                                        <th scope="col">Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-primary" data-target="#modalLerEmail" data-toggle="modal" style="cursor:pointer" id="XXX">
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Assunto Recebido 01</td>
                                        <td>22/08/2018</td>
                                    </tr>
                                    <tr class="text-primary" data-target="#modalLerEmail" data-toggle="modal" style="cursor:pointer" id="YYY">
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Assunto Recebido 02</td>
                                        <td>21/08/2018</td>
                                    </tr>
                                    <tr class="text-primary" data-target="#modalLerEmail" data-toggle="modal" style="cursor:pointer" id="ZZZ">
                                        <th scope="row">3</th>
                                        <td>Larry the Bird</td>
                                        <td>Assunto Recebido 03</td>
                                        <td>20/08/2018</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Enviados -->
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">                            
                            <table class="table table-sm table-hover text-center">
                                <thead>
                                    <tr class="text-dark bg-light">
                                        <th scope="col">Nº</th>
                                        <th scope="col">Para</th>
                                        <th scope="col">Assunto</th>
                                        <th scope="col">Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-secondary enviado" data-target="#modalLerEmail" data-toggle="modal" style="cursor:pointer">
                                        <th scope="row">1</th>
                                        <td>Gambit</td>
                                        <td>Assunto Enviado 1</td>
                                        <td>25/08/2018</td>
                                    </tr>
                                    <tr class="text-secondary enviado" data-target="#modalLerEmail" data-toggle="modal" style="cursor:pointer">
                                        <th scope="row">2</th>
                                        <td>Logan</td>
                                        <td>Assunto Enviado 2</td>
                                        <td>24/08/2018</td>
                                    </tr>
                                    <tr class="text-secondary enviado" data-target="#modalLerEmail" data-toggle="modal" style="cursor:pointer">
                                        <th scope="row">3</th>
                                        <td>Peter Paker</td>
                                        <td>Assunto Enviado 03</td>
                                        <td>26/08/2018</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>                       
                    </div>                    
                </div>
            </div> <!-- FIM DO CONTEÚDO --> 
            
            <!-- MODAL NOVO E-MAIL -->
			<div class="modal fade" id="modalNovoEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><span class="text-primary"><i class="fas fa-envelope"></i></span>&nbsp;Novo E-mail</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="" id="formNovoEmail">
                                    <div class="form-group">
                                            <label for="exampleInputPara">Para:</label>                
                                        <input type="text" class="form-control" name="novoEmailPara" id="novoEmailPara" placeholder="Para" required>        
                                    </div>
                                    <div class="form-group">
                                            <label for="exampleInputAssunto">Assunto:</label>                
                                        <input type="text" class="form-control" name="novoEmailAssunto" id="novoEmailAssunto" aria-describedby="Assunto" placeholder="Assunto" required></textarea>          
                                    </div>
                                    <div class="form-group">
                                            <label for="exampleInputTextarea">Mensagem:</label>                
                                        <textarea class="form-control" name="novoEmailMensagem" id="novoEmailMensagem" style="resize:none" aria-describedby="Mensagem" placeholder="Mensagem" rows="5" required></textarea>          
                                    </div>
                                </form>                                        
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button> -->
                                <button type="button" class="btn btn-primary" id="btnNovoEmail"><i class="fas fa-arrow-circle-right"></i>&nbsp;Enviar</button>
                            </div>
                            
                        </div>
                    </div>
                </div> <!-- FIM MODAL NOVO E-MAIL -->

                <!-- MODAL LEITURA DE E-MAILS RECEBIDOS -->
                <div class="modal fade" id="modalLerEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-primary" name="modalLeituraAssunto" id="modalLeituraAssunto">Assunto...</h5>
                                <button type="button" class="close" id="fecharModalLeitura" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="" id="formEmail">                                    
                                    <h6 class="text-dark"><span class="text-secondary" id="deModalLeitura"></span></h6>
                                    <small class="form-text text-muted" id="dataEmail">Data da Mensagem</small>      
                                    <p class="text-dark"><span class="text-secondary" id="paraModalLeitura"></span></p>                            
                                    <!-- Área da Messagem -->
                                    <div class="form-group">
                                        <!-- <label for="exampleInputTextarea">Mensagem:</label> -->
                                        <textarea class="form-control bg-light" id="leituraMensagem" style="resize:none" aria-describedby="Mensagem" placeholder="Mensagem" rows="5" readonly></textarea>          
                                    </div>

                                    <!-- Área da Resposta -->
                                    <div class="form-group" name="emailResposta" id="emailResposta" style="display: none">
                                        <!-- <label for="exampleInputTextarea">Resposta:</label> -->
                                        <textarea class="form-control" name="modalLeituraMensagemResposta" id="modalLeituraMensagemResposta" style="resize:none" aria-describedby="Mensagem" placeholder="Digite a sua Resposta" rows="5"></textarea>          
                                    </div>
                                </form>                                        
                            </div>
                            
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button> -->
                                <button type="button" class="btn btn-primary" id="btnResponder"><i class="fas fa-share-square"></i>&nbsp;Responder</button>
                                <button type="button" class="btn btn-primary" id="btnEnviarResposta" style="display: none"><i class="fas fa-arrow-circle-right"></i>&nbsp;Enviar</button>
                            </div>
                            
                        </div>
                    </div>
                </div> <!-- FIM MODAL LEITURA DE E-MAILS RECEBIDOS -->

        </div>



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="../js/funcoes.js"></script>
    </body>    
</html>