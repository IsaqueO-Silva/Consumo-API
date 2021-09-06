/* Função utilizada para consulta de CEP no webservice ViaCEP */
function consultaCepViaCEP() {
    let cep = document.getElementById('cep').value;

    /* Objeto utilizado na requisição AJAX */
    xmlHttp = new XMLHttpRequest();

    /* Tratando e capturando o retorno do servidor */
    xmlHttp.onreadystatechange = function() {
        if((this.readyState == 4) && (this.status == 200)) {
            /* Convertendo o JSON retornado em objeto(Object) */
            let result = JSON.parse(this.responseText);

            /* Mostrando a resposta do servidor */
            if(result.erro) {
                /* Em caso de erro os campos são limpos */
                document.getElementById('logradouro').value     = '';
                document.getElementById('complemento').value    = '';
                document.getElementById('bairro').value         = '';
                document.getElementById('uf').value             = '';
                document.getElementById('codigoIBGE').value     = '';
                document.getElementById('localidade').value     = '';
                document.getElementById('gia').value            = '';
                document.getElementById('ddd').value            = '';
                document.getElementById('siafi').value          = '';

                /* Mensagem de erro */
                if(result.message) {
                    document.getElementById('status').innerHTML = '<div class="alert alert-danger" role="alert"><strong>'+result.message+'</strong></alert>';
                }
                else {
                    document.getElementById('status').innerHTML = '<div class="alert alert-danger" role="alert"><strong>CEP inexistente!</strong></alert>';
                }                
            }
            else {
                /* Populando os campos do formulário com o resultado da consulta */
                document.getElementById('logradouro').value     = result.logradouro;
                document.getElementById('complemento').value    = result.complemento;
                document.getElementById('bairro').value         = result.bairro;
                document.getElementById('uf').value             = result.uf;
                document.getElementById('codigoIBGE').value     = result.ibge;
                document.getElementById('localidade').value     = result.localidade;
                document.getElementById('gia').value            = result.gia;
                document.getElementById('ddd').value            = result.ddd;
                document.getElementById('siafi').value          = result.siafi;

                document.getElementById('status').innerHTML = '<div class="alert alert-success" role="alert"><strong>CEP consultado com sucesso.</strong></alert>';
            }
        }
    }

    /* Criando e enviando a requisição */
    xmlHttp.open('POST', 'Class/ViaCEP/ViaCEPController.php?status=consultaCepViaCEP&cep='+cep, true);

    xmlHttp.send();
}