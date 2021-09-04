<?php

require_once('../../assets/utilitarios/utilitarios.php');
//require_once('ViaCEPModel.php');

class ViaCEPController {

    private $cep;

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
    #endregion

    public function consultaCepViaCEPController() {
        echo $this->get_cep();
    }
}

/* Definindo qual método da classe deve ser chamado */
if(isset($_REQUEST['status'])) {
    
    switch($_REQUEST['status']) {

        case 'consultaCepViaCEP':
            $viaCEPController = new ViaCEPController([
                'cep'   => sanitizar($_REQUEST['cep'])
            ]);

            $viaCEPController->consultaCepViaCEPController();
        break;
    }
}
?>