$(document).ready(function(){

    /* Relacionando os Emails Recebidos */  
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

        /* Relacionando os Emails Enviados */
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

});
