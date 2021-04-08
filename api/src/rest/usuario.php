<?php

    require_once __DIR__ . "/../control/usuario_control.php";
    require_once __DIR__ . "/../model/generic/generic_dao.php";
    
    /* Trata request */
    $json = $_REQUEST;
    if (empty($json)) $json = file_get_contents("php://input");
    if (!is_array($json)) $json = json_decode($json, true);

    // chamando o metodo solicitado
    ("usuario_".$json['metodo'])($json);

    function usuario_listar ($json) {
        $control = new usuario_control();
        $resp = $control->listar();
        
        echo json_encode($resp);
    }

    function usuario_cadastrar ($json) {
        $data = $json['data'];

        $control = new usuario_control($data);
        $resp = $control->cadastrar();
        echo json_encode($resp);
    }

    function usuario_atualizar ($json) {
        $data = $json['data'];
        
        $control = new usuario_control($data);
        $resp = $control->atualizar();
        echo json_encode($resp);
    }

    function usuario_remover ($json) {
        $id = $json['id'];

        $material_dao = new usuario_dao();
        $resp = $material_dao->remover($id);
        echo json_encode($resp);
    }
?>