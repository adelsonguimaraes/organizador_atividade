<?php

    require_once __DIR__ . "/../model/atividade/atividade_dao.php";
    require_once __DIR__ . "/../model/generic/generic_dao.php";
    
    /* Trata request */
    $json = $_REQUEST;
    if (empty($json)) $json = file_get_contents("php://input");
    if (!is_array($json)) $json = json_decode($json, true);

    // chamando o metodo solicitado
    "atividade_".($json['metodo'])($json);

    function atividade_listar ($json) {
        $atividade_dao = new atividade_dao();
        $resp = $atividade_dao->listar();
        
        echo json_encode($resp);
    }

    function atividade_cadastrar ($json) {
        $data = $json['data'];

        $atividade_dao = new atividade_dao();
        $resp = $atividade_dao->cadastrar($data);
        echo json_encode($resp);
    }

    function atividade_atualizar ($json) {
        $data = $json['data'];
        
        $atividade_dao = new atividade_dao();
        $resp = $atividade_dao->atualizar($data);
        echo json_encode($resp);
    }

    function atividade_remover ($json) {
        $id = $json['id'];

        $material_dao = new atividade_dao();
        $resp = $material_dao->remover($id);
        echo json_encode($resp);
    }
?>