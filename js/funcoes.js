$(document).ready(function(){

    // Contando quantas linhas tem na tabela de e-mail
    //var qtdLinhas = $('#tblCaixaEntrada tbody tr').length;
    //$('.contEmail').html(qtdLinhas);    

    /* TOPO DAS PÁGINAS */
    $('#btnMenuSair').click(function(){
        var funcao = 'sair';
        
        $.ajax({
            type:'post',
            url:'../php/funcoes.php',
            data: {funcao},
            dataType:'html',
            success:function(retorno){
                //console.log(retorno);               
                location.href='../index.html';  
            },
            failure:function(msgErro){
                console.log(msgErro);
            },
            error:function(erro){
                console.log(erro);
            }
        });    
    });

    /* PÁGINA INDEX */
    // Função de Login
    $('#btnLogin').click(function(){
        //location.href='paginas/inicio.php';          
        var funcao = 'login';                      
        var dados = $('#formLogin').serialize();               
        
        $.ajax({
            type:'post',
            url:'php/funcoes.php',
            data: {funcao,dados},
            dataType:'html',
            success:function(retorno){
                //console.log(retorno);
                if (retorno == '0'){
					alert('Favor Preencher todos os Campos!')					
                }
                else if(retorno == 'Inativo'){
                    alert('Conta Inativa, Favor Verificar seu E-mail de Cadastro!');
                }
				else if(retorno == '1') {
                    location.href='paginas/inicio.php';					
				} else if(retorno == '2'){
					alert('Email ou Senha Invalido!');
					$('#email').focus();	
				} else{
                    alert('Usuário não Cadastrado no Sistema!');
					$('#email').focus();
                }
            },
            failure:function(msgErro){
                console.log(msgErro);
            },
            error:function(erro){
                console.log(erro);
            }
        });    

    });

    // Dar foco no Input E-mail
    $("#email").focus();

    // Detectar Quando Pressionar a Tecla Enter
	$(document).keypress(function(e) {
		if(e.which == 13) {
			$("#btnLogin").click();
		}
	});
	
	// Função de Cadastro
    $('#btnModalCadastrar').click(function(){                
        var funcao = 'cadastro';                      
        var dados = $('#formCadastro').serialize();          

        $.ajax({
            type:'post',
            url:'php/funcoes.php',
            data: {funcao,dados},
            dataType:'html',
            success:function(retorno){
                //console.log(retorno);
                if (retorno == 'falha'){
					alert('Dados Enexistentes!');
                } else if(retorno == 'falha2'){
					alert('Favor Preencher todos os Campos!');
                } else if(retorno == 'falha3'){
                    alert('As Senhas Divergem!');
                    $('#modalSenhaCadastro').focus();
                } else if(retorno == 'cadastrado'){
                    alert('Já Existe um Cadastro com o E-mail Informado!');
                    $('#modalCadastroEmail').focus();
                } else if (retorno == '1'){
                    alert('Cadastrado Realizado com Sucesso, um E-mail Será Enviado para Confirmação do seu Cadastro!');					
                    $('#formCadastro').each(function(){
                        this.reset();
                    });
                    location.href='index.html';
				}
            },
            failure:function(msgErro){
                console.log(msgErro);
            },
            error:function(erro){
                console.log(erro);
            }
        });      

    });

    // Detectar Quando Pressionar a Tecla Enter
	$(document).keypress(function(e) {
		if(e.which == 13) {
			$("#btnModalCadastrar").click();
		}
	});

    // Limpar os Campos do Formulário de Cadastro
    /*$('#modalCadastro').on('hidden.bs.modal', function () {
        $('#formCadastro').each(function(){
            this.reset();
        });
    });*/    

    /* PÁGINA DE EMAIL */
	
    // Relacionando os Emails Recebidos   
	var funcao = 'consultaEmailRecebido';
	
	$.ajax({
        type:'post',
        url:'../php/funcoes.php',
        data: {funcao},
        dataType:'json',
        success:function(retorno){
            //console.log(retorno.length);
            for(i = 0; i < retorno.length; i++){
                $('#tblCaixaEntrada').append(
                    '<tr class="text-primary recebido" data-target="#modalLerEmail" data-toggle="modal" style="cursor:pointer" id="'+ retorno[i].pk_email +'">'
                        +'<th scope="row">'+ (i+1) +'</th>'
                        +'<td>'+ retorno[i].nome +'</td>'
                        +'<td>'+ retorno[i].assunto +'</td>'
                        +'<td>'+ retorno[i].data_mensagem +'</td>'
                    +'</tr>');
            }    	
        },
        failure:function(msgErro){
            console.log(msgErro);
        },
        error:function(erro){
            console.log(erro);
        }
    }); 
    
    // Relacionando os Emails Enviados  
	var funcao = 'consultaEmailEnviado';
	
	$.ajax({
        type:'post',
        url:'../php/funcoes.php',
        data: {funcao},
        dataType:'json',
        success:function(retorno){
            //console.log(retorno.length);
            for(i = 0; i < retorno.length; i++){
                $('#tblCaixaSaida').append(
                    '<tr class="text-secondary enviado" data-target="#modalLerEmail" data-toggle="modal" style="cursor:pointer" id="'+ retorno[i].pk_email +'">'
                        +'<th scope="row">'+ (i+1) +'</th>'
                        +'<td>'+ retorno[i].nome +'</td>'
                        +'<td>'+ retorno[i].assunto +'</td>'
                        +'<td>'+ retorno[i].data_mensagem +'</td>'
                    +'</tr>');
            }    	
        },
        failure:function(msgErro){
            console.log(msgErro);
        },
        error:function(erro){
            console.log(erro);
        }
    });    
    
    // Contar E-mails não Lidos
    var funcao = 'contarEmailNaoLido';

    $.ajax({
        type:'post',
        url:'../php/funcoes.php',
        data: {funcao},
        dataType:'html',
        success:function(retorno){
            //console.log(retorno);                           	
        },
        failure:function(msgErro){
            console.log(msgErro);
        },
        error:function(erro){
            console.log(erro);
        }
    });    

    $('#modalLerEmail').on('hidden.bs.modal', function () {
        $('#fecharModalLeitura').click();
    });
	
	// Pesquisar Usuários Cadastrados
	$('#novoEmailPara').keyup(function(){
		var funcao = 'pesquisarUser';	
		var texto = $(this).val();
		//console.log(texto);
		
		$.ajax({
			type:'post',
			url:'../php/funcoes.php',
			data: {funcao, texto},
			dataType:'json',
			success:function(retorno){
                //console.log(retorno);
                if(retorno != false){
                    //for(i = 0; i < retorno.length; i++){
                    $('').empty();    
                    $('#novoEmailGrupo').append(                                               
                            //+'<div class="dropdown-menu" id="dropdown-menu1" aria-labelledby="dropdownMenu">'
                            //+   '<button type="button" class="dropdown-item" id="">'+ retorno.nome +'</button>'            
                            //+'</div>'
                        '<ul>'
                            +'<li><a href="#">'+ retorno.pk_usuario + ' - ' + retorno.nome +'</a></li>'    
                       +'</ul>');
                //}
                }  				
			},
			failure:function(msgErro){
				console.log(msgErro);
			},
			error:function(erro){
				console.log(erro);
			}
		});     
	});
    
    /* Click nas Linhas das Tabelas */
    // Leitura de E-mails
    $(document).on('click','tbody tr',function(){
        // Pegando o nome da classe da linha
        var funcao = 'lerEmail';
        var classe = $(this).attr('class');        
        var recebido = $(this).hasClass('recebido');
        idEmail = this.id;
        
        if(recebido){
            var acao = 'recebido';
        } else{
            var acao = 'enviado';
        }

        $.ajax({
			type:'post',
			url:'../php/funcoes.php',
			data: {funcao, acao},
			dataType:'json',
			success:function(retorno){
                //console.log(retorno);            
                $('#deModalLeitura').html('De: ' + retorno.nome);
                $('#paraModalLeitura').html('Para: ');
                $('#modalLeituraAssunto').html(retorno.assunto);
                $('#leituraMensagem').html(retorno.conteudo);
                $('#dataEmail').html(retorno.data_mensagem);                 				
			},
			failure:function(msgErro){
				console.log(msgErro);
			},
			error:function(erro){
				console.log(erro);
			}
		});       
               
        // Pegando o texto das colunas
        var coluna = $(this).children();       
        var dados = {
            'id':$(coluna[0]).text(),
            'nome':$(coluna[1]).text(),
            'assunto':$(coluna[2]).text(),
            'data':$(coluna[3]).text()
        };
        
       if($(this).hasClass('enviado')){
            // Setando os valores das colunas na modal de leitura
            /*$('#modalLeituraAssunto').html(dados.assunto);           
            $('#deModalLeitura').html('De: Usuário');
            $('#paraModalLeitura').html('Para: ' + dados.nome);
            $('#dataEmail').html(dados.data);
            $('#leituraMensagem').html('Esta é uma mensagem que foi Enviada como teste!');*/
            $('#btnResponder').css('display','none');            
        } else{  
            $('#btnResponder').css('display','block'); 
            // Setando os valores das colunas na modal de leitura
            /*$('#modalLeituraAssunto').html(dados.assunto);
            $('#deModalLeitura').html('De: ' + dados.nome);
            $('#paraModalLeitura').html('Para: Usuário');
            $('#dataEmail').html(dados.data);
            $('#leituraMensagem').html('Esta é uma mensagem que foi Recebida como teste!');*/

            // Mostra a div com o campo de resposta
            $('#btnResponder').click(function(){
                $('#emailResposta').css('display','block');
                $('#btnEnviarResposta').css('display','block');
                $('#btnResponder').css('display','none');            
            });

            // Esconde a div com o campo de resposta
            $('#fecharModalLeitura').click(function(){
                //window.location.reload(); /* Dá refresh na página */
                $('#emailResposta').css('display','none');
                $('#btnEnviarResposta').css('display','none');
                $('#btnResponder').css('display','block');
            });
        }
        // Removendo a classe atual e setando a nova classe na linha
        $(this).removeClass('text-primary');
        $(this).addClass('text-secondary');
    });	
	
	// Enviar E-mail
		$('#btnNovoEmail').click(function(){			
			var funcao = 'enviarEmail';
			var acao = 'novoEmail';
			var dados = $('#formNovoEmail').serialize();
		
			$.ajax({
				type:'post',
				url:'../php/funcoes.php',
				data: {funcao, acao, dados},
				dataType:'html',
				success:function(retorno){
					console.log(retorno);
					if(retorno == '1'){
                        alert('Mesagem Enviada com Sucesso.');
                        window.location.reload();                        
					}
				},
				failure:function(msgErro){
					console.log(msgErro);
				},
				error:function(erro){
					console.log(erro);
				}
			});   
		});
		
		// Enviar E-mail Resposta
		$('#btnEnviarResposta').click(function(){
            var funcao = 'enviarEmail';
			var acao = 'resposta';
            var idResposta = idEmail;
			var mensagem = $('#modalLeituraMensagemResposta').val();
			
			$.ajax({
				type:'post',
				url:'../php/funcoes.php',
				data: {funcao, acao, idResposta, mensagem},
				dataType:'html',
				success:function(retorno){
					console.log(retorno);
					 window.location.reload(); 
				},
				failure:function(msgErro){
					console.log(msgErro);
				},
				error:function(erro){
					console.log(erro);
				}
			});      
        });	

		
});		