<?php

    require_once __DIR__ . "/../control/projeto_control.php";
    require_once __DIR__ . "/../model/generic/generic_dao.php";
    
    /* Trata request */
    $json = $_REQUEST;
    if (empty($json)) $json = file_get_contents("php://input");
    if (!is_array($json)) $json = json_decode($json, true);

    // chamando o metodo solicitado
    ("projeto_".$json['metodo'])($json);

    function projeto_listar ($json) {
        $projeto_dao = new projeto_control();
        $resp = $projeto_dao->listar();
        
        echo json_encode($resp);
    }

    function projeto_cadastrar ($json) {
        $data = $json['data'];

        $projeto_dao = new projeto_control($data);
        $resp = $projeto_dao->cadastrar();
        echo json_encode($resp);
    }

    function projeto_atualizar ($json) {
        $data = $json['data'];
        
        $projeto_dao = new projeto_control($data);
        $resp = $projeto_dao->atualizar();
        echo json_encode($resp);
    }

    function projeto_remover ($json) {
        $id = $json['id'];

        $produto_control = new projeto_control();
        $resp = $produto_control->remover($id);
        echo json_encode($resp);
    }
?>