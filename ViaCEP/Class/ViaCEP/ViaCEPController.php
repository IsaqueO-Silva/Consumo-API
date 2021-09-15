<?php

require_once('../../config/config.php');

class ViaCEPController {

    private $cep;
    private $result;

    #region
    public function __construct($args) {
        $this->cep = $args['cep'];
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setResult($result) {
        $this->result = $result;
    }

    public function getResult() {
        return $this->result;
    }
    #endregion

    /* Função utilizada para consulta de CEP no webservice ViaCEP */
    public function consultaCepViaCEPController() {
        /* Instânciando o objeto Model */
        $viaCEPModel = new ViaCEPModel([
            'cep'   => $this->getCep()
        ]);

        $viaCEPModel->consultaCepViaCEPModel();

        /* Capturando o retorno do Model */
        $this->setResult($viaCEPModel->getResult());

        /* Retorno do Controller */
        echo($this->getResult());
    }
}

/* Definindo qual método da classe deve ser chamado */
if(isset($_REQUEST['status'])) {
    
    switch($_REQUEST['status']) {

        case 'consultaCepViaCEP':
            $viaCEPController = new ViaCEPController([
                'cep'   => Utilitarios::sanitizar($_REQUEST['cep'])
            ]);

            $viaCEPController->consultaCepViaCEPController();
        break;
    }
}
?>