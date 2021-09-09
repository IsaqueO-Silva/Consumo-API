<?php

require_once('../../utilitarios/utilitarios.php');
require_once('ViaCEPModel.php');

class ViaCEPController {

    private $cep;
    private $result;

    #region
    public function __construct($args) {
        $this->cep = $args['cep'];
    }

    public function set_cep($cep) {
        $this->cep = $cep;
    }

    public function get_cep() {
        return $this->cep;
    }

    public function set_result($result) {
        $this->result = $result;
    }

    public function get_result() {
        return $this->result;
    }
    #endregion

    /* Função utilizada para consulta de CEP no webservice ViaCEP */
    public function consultaCepViaCEPController() {
        /* Instânciando o objeto Model */
        $viaCEPModel = new ViaCEPModel([
            'cep'   => $this->get_cep()
        ]);

        $viaCEPModel->consultaCepViaCEPModel();

        /* Capturando o retorno do Model */
        $this->set_result($viaCEPModel->get_result());

        /* Retorno do Controller */
        echo($this->get_result());
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