/* Função utilizada para consulta de CEP no webservice ViaCEP */
function consultaCepViaCEP() {
    let cep = document.getElementById('cep').value;

    /* Objeto utilizado na requisição AJAX */
    xmlHttp = new XMLHttpRequest();

    /* Tratando e capturando o retorno do servidor */
    xmlHttp.onreadystatechange = function() {
        if((this.readyState == 4) && (this.status == 200)) {
            alert(this.responseText);
        }
    }

    /* Criando e enviando a requisição */
    xmlHttp.open('POST', 'Class/ViaCEP/ViaCEPController.php?status=consultaCepViaCEP&cep='+cep, true);

    xmlHttp.send();
}