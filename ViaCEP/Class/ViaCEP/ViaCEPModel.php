<?php

class ViaCEPModel {

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

    public function consultaCepViaCEPModel() {
        try {
            /* Array usado no retorno da função */
            $result = [];

            /* Campo(s) obrigatórios */
            if(empty($this->get_cep())) {
                /* Retorno */
                $result['erro']     = true;
                $result['message']  = 'Por favor, preencha o campo CEP!';

                $this->set_result(json_encode($result));
            }
            else if(strlen($this->get_cep()) < 8) {
                /* Retorno */
                $result['erro']     = true;
                $result['message']  = 'Atenção, o campo CEP deve conter 8 caracteres.';

                $this->set_result(json_encode($result));
            }
            else {
                /* Inicializando a requisição a API ViaCEP */
                $curl   = curl_init('https://viacep.com.br/ws/'.$this->get_cep().'/json/');
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                /* Capturando a resposta do servidor */
                $responseCurl   = curl_exec($curl);

                /* Retorno */
                $this->set_result($responseCurl);

                /* Fechando a requisição */
                curl_close($curl);
            }
        }
        catch(Exception $e) {
            /* Retorno */
            $result['erro']    = true;
            $result['message']  = 'Erro ao consultar o CEP!';

            $this->set_result(json_encode($result));
        }
    }
}
?>