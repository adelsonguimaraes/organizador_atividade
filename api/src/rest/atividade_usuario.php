<?php

    require_once __DIR__ . "/../model/atividade_usuario/atividade_usuario_dao.php";
    require_once __DIR__ . "/../model/generic/generic_dao.php";
    
    /* Trata request */
    $json = $_REQUEST;
    if (empty($json)) $json = file_get_contents("php://input");
    if (!is_array($json)) $json = json_decode($json, true);

    // chamando o metodo solicitado
    "atividade_usuario_".($json['metodo'])($json);

    function atividade_usuario_listar ($json) {
        $atividade_usuario_dao = new atividade_usuario_dao();
        $resp = $atividade_usuario_dao->listar();
        
        echo json_encode($resp);
    }

    function atividade_usuario_cadastrar ($json) {
        $data = $json['data'];

        $atividade_usuario_dao = new atividade_usuario_dao();
        $resp = $atividade_usuario_dao->cadastrar($data);
        echo json_encode($resp);
    }

    function atividade_usuario_atualizar ($json) {
        $data = $json['data'];
        
        $atividade_usuario_dao = new atividade_usuario_dao();
        $resp = $atividade_usuario_dao->atualizar($data);
        echo json_encode($resp);
    }

    function atividade_usuario_remover ($json) {
        $id = $json['id'];

        $material_dao = new atividade_usuario_dao();
        $resp = $material_dao->remover($id);
        echo json_encode($resp);
    }
?>