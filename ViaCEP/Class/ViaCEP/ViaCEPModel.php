<?php

class ViaCEPModel {

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

    public function consultaCepViaCEPModel() {
        try {
            /* Array usado no retorno da função */
            $result = [];

            /* Campo(s) obrigatórios */
            if(empty($this->getCep())) {
                /* Retorno */
                $result['erro']     = true;
                $result['message']  = 'Por favor, preencha o campo CEP!';

                $this->setResult(json_encode($result));
            }
            else if(strlen($this->getCep()) < 8) {
                /* Retorno */
                $result['erro']     = true;
                $result['message']  = 'Atenção, o campo CEP deve conter 8 caracteres.';

                $this->setResult(json_encode($result));
            }
            else {
                /* Inicializando a requisição a API ViaCEP */
                $curl   = curl_init('https://viacep.com.br/ws/'.$this->getCep().'/json/');
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                /* Capturando a resposta do servidor */
                $responseCurl   = curl_exec($curl);

                /* Retorno */
                $this->setResult($responseCurl);

                /* Fechando a requisição */
                curl_close($curl);
            }
        }
        catch(Exception $e) {
            /* Retorno */
            $result['erro']    = true;
            $result['message']  = 'Erro ao consultar o CEP!';

            $this->setResult(json_encode($result));
        }
    }
}
?>