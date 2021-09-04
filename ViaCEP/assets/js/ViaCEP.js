/* Função utilizada para consulta de CEP no webservice ViaCEP */
function consultaCepViaCEP() {
    let cep = document.getElementById('cep').value;

    /* Objeto utilizado na requisição AJAX */
    xmlHttp = new XMLHttpRequest();

    /* Tratando e capturando o retorno do servidor */
    xmlHttp.onreadystatechange = function() {
        if((this.readyState == 4) && (this.status == 200)) {
            /* Convertendo o JSON retornado em objeto(Object) */
            alert(this.responseText);

            let result = JSON.parse(this.responseText);

            /* Mostrando a resposta do servidor */
            if(result.error) {
                document.getElementById('status').innerHTML = '<div class="alert alert-danger" role="alert"><strong>'+result.message+'</strong></alert>';
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

                //document.getElementById('status').innerHTML = '<div class="alert alert-danger" role="alert"><strong>'+result+'</strong></alert>';
            }
        }
    }

    /* Criando e enviando a requisição */
    xmlHttp.open('POST', 'Class/ViaCEP/ViaCEPController.php?status=consultaCepViaCEP&cep='+cep, true);

    xmlHttp.send();
}