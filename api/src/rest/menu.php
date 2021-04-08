<?php

    require_once __DIR__ . "/../model/menu/menu_dao.php";
    require_once __DIR__ . "/../model/generic/generic_dao.php";
    
    /* Trata request */
    $json = $_REQUEST;
    if (empty($json)) $json = file_get_contents("php://input");
    if (!is_array($json)) $json = json_decode($json, true);

    // chamando o metodo solicitado
    $json['metodo']($json);

    function listar ($json) {
        $menu_dao = new menu_dao();
        $resp = $menu_dao->listar();
        
        echo json_encode($resp);
    }

    function cadastrar ($json) {
        $data = $json['data'];

        $menu_dao = new menu_dao();
        $resp = $menu_dao->cadastrar($data);
        echo json_encode($resp);
    }

    function atualizar ($json) {
        $data = $json['data'];

        $menu_dao = new menu_dao();
        $resp = $menu_dao->atualizar($data);
        echo json_encode($resp);
    }

    function remover ($json) {
        $id = $json['id'];

        $menu_dao = new menu_dao();
        $resp = $menu_dao->remover($id);
        echo json_encode($resp);
    }
?>