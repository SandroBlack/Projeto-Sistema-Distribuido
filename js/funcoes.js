$(document).ready(function(){

    // Contando quantas linhas tem na tabela de e-mail
    var qtdLinhas = $('#tblCaixaEntrada tbody tr').length;
    $('.contEmail').html(qtdLinhas);    

    /* TOPO DAS PÁGINAS */
    $('#btnMenuSair').click(function(){
        location.href='../index.html';
    });

    /* PÁGINA INDEX */
    // Função de Login
    $('#btnLogin').click(function(){
        location.href='paginas/inicio.html';          
        var funcao = 'login';                      
        var dados = $('#formLogin').serialize();               
       
        $.ajax({
            type:'post',
            url:'php/funcoes.php',
            data: {funcao,dados},
            dataType:'html',
            success:function(retorno){
                console.log(retorno);
            },
            failure:function(msgErro){
                console.log(msgErro);
            },
            error:function(erro){
                console.log(erro);
            }
        });       

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
                console.log(retorno);
            },
            failure:function(msgErro){
                console.log(msgErro);
            },
            error:function(erro){
                console.log(erro);
            }
        });       

    });

    // Limpar os Campos do Formulário de Cadastro
    /*$('#modalCadastro').on('hidden.bs.modal', function () {
        $('#formCadastro').each(function(){
            this.reset();
        });
    });*/    

    /* PÁGINA DE EMAIL */
    $('#modalLerEmail').on('hidden.bs.modal', function () {
        $('#fecharModalLeitura').click();
    });
    
    $(document).on('click','tbody tr',function(){
        
        // Pegando o nome da classe da linha
        var classe = $(this).attr('class');
               
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
            $('#modalLeituraAssunto').html(dados.assunto);           
            $('#deModalLeitura').html('De: Usuário');
            $('#paraModalLeitura').html('Para: ' + dados.nome);
            $('#dataEmail').html(dados.data);
            $('#leituraMensagem').html('Esta é uma mensagem que foi Enviada como teste!');
            $('#btnResponder').css('display','none');            
        } else{  
            $('#btnResponder').css('display','block'); 
            // Setando os valores das colunas na modal de leitura
            $('#modalLeituraAssunto').html(dados.assunto);
            $('#deModalLeitura').html('De: ' + dados.nome);
            $('#paraModalLeitura').html('Para: Usuário');
            $('#dataEmail').html(dados.data);
            $('#leituraMensagem').html('Esta é uma mensagem que foi Recebida como teste!');

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

    
});