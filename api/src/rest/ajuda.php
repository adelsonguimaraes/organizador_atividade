<?php

    require_once __DIR__ . "/../model/ajuda/ajuda_dao.php";
    require_once __DIR__ . "/../model/generic/generic_dao.php";
    
    /* Trata request */
    $json = $_REQUEST;
    if (empty($json)) $json = file_get_contents("php://input");
    if (!is_array($json)) $json = json_decode($json, true);

    // chamando o metodo solicitado
    $json['metodo']($json);

    function listar ($json) {
        $ajuda_dao = new ajuda_dao();
        $resp = $ajuda_dao->listar();
        
        echo json_encode($resp);
    }

    function cadastrar ($json) {
        $data = $json['data'];

        $ajuda_dao = new ajuda_dao();
        $resp = $ajuda_dao->cadastrar($data);
        echo json_encode($resp);
    }

    function atualizar ($json) {
        $data = $json['data'];
        
        $ajuda_dao = new ajuda_dao();
        $resp = $ajuda_dao->atualizar($data);
        echo json_encode($resp);
    }

    function remover ($json) {
        $id = $json['id'];

        $material_dao = new ajuda_dao();
        $resp = $material_dao->remover($id);
        echo json_encode($resp);
    }
?>