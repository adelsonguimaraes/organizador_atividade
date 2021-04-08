<?php

    require_once __DIR__ . "/../model/projeto_usuario/projeto_usuario_dao.php";
    require_once __DIR__ . "/../model/generic/generic_dao.php";
    
    /* Trata request */
    $json = $_REQUEST;
    if (empty($json)) $json = file_get_contents("php://input");
    if (!is_array($json)) $json = json_decode($json, true);

    // chamando o metodo solicitado
    "projeto_usuario_".($json['metodo'])($json);

    function projeto_usuario_listar ($json) {
        $projeto_usuario_dao = new projeto_usuario_dao();
        $resp = $projeto_usuario_dao->listar();
        
        echo json_encode($resp);
    }

    function projeto_usuario_cadastrar ($json) {
        $data = $json['data'];

        $projeto_usuario_dao = new projeto_usuario_dao();
        $resp = $projeto_usuario_dao->cadastrar($data);
        echo json_encode($resp);
    }

    function projeto_usuario_atualizar ($json) {
        $data = $json['data'];
        
        $projeto_usuario_dao = new projeto_usuario_dao();
        $resp = $projeto_usuario_dao->atualizar($data);
        echo json_encode($resp);
    }

    function projeto_usuario_remover ($json) {
        $id = $json['id'];

        $material_dao = new projeto_usuario_dao();
        $resp = $material_dao->remover($id);
        echo json_encode($resp);
    }
?>