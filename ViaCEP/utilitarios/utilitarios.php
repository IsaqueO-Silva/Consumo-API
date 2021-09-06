<?php
    /* Função utilizada para limpar dados do formulário */
    function sanitizar($dado) {
        $dado = trim($dado);
        $dado = stripslashes($dado);
        $dado = htmlspecialchars($dado);
        $dado = str_replace('.', '', $dado);
        $dado = str_replace('-', '', $dado);

        return $dado;
    }
?>