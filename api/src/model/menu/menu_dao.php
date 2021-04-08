<?php

// dao item
class menu_dao {
    private $path = "";
    private $generic = null;
    private $class = "";

    //construtor
	public function __construct() {
        $this->path = "menu.json";
        $this->class = "Menu";
        $this->generic = new generic_dao($this->path, $this->class); // composição
	}

    function cadastrar ($obj) {
        return $this->generic->cadastrar(
            array(
                "id"=> "",
                "menu"=> $obj['menu'],
                "icon"=> $obj['icon'],
                "link"=> $obj['link']
            )
        );
    }

    function atualizar ($obj) {
        return $this->generic->atualizar(
            array(
                "id"=> intval($obj['id']),
                "menu"=> $obj['menu'],
                "icon"=> $obj['icon'],
                "link"=> $obj['link']
            )
        );
    }

    function buscarPorId ($id) {
        return $this->generic->buscarPorId($id);
    }

    function listar () {
        return $this->generic->listar();
    }

    function remover ($id) {
        return $this->generic->remover($id);
    }
}

?>