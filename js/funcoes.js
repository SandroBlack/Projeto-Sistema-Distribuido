$(document).ready(function(){

    // Contando quantas linhas tem na tabela
    var qtdLinhas = $('#tblCaixaEntrada tbody tr').length;
    $('.contEmail').html(qtdLinhas);    

    /* PÁGINA DE LOGIN */
    $('#btnLogin').click(function(){
        location.href='paginas/inicio.html';        
    });

    /* TOPO DAS PÁGINAS */
    $('#btnMenuSair').click(function(){
        location.href='../index.html';
    });

    /* PÁGINA DE EMAIL */
    $(document).on('click','tbody tr',function(){
        /*window.location = $(this).data('url');
        return false;*/       
        //alert(this.id);        

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
            $('#labelModalLeitura').html(dados.assunto);           
            $('#deModalLeitura').html('De: Usuário');
            $('#paraModalLeitura').html('Para: ' + dados.nome);
            $('#dataEmail').html(dados.data);
            $('#leituraMensagem').html('Esta é uma mensagem que foi Enviada como teste!');
            $('#btnResponder').css('display','none');            
        } else{  
            $('#btnResponder').css('display','block'); 
            // Setando os valores das colunas na modal de leitura
            $('#labelModalLeitura').html(dados.assunto);
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