<?php

require_once __DIR__ . "/../generic/generic_dao.php";
require_once __DIR__ . "/projeto.php";

// dao projeto
class projeto_dao {
    private $path = "";
    private $generic = null;
    private $class = "";

    //construtor
	public function __construct() {
        $this->path = "projeto.json";
        $this->class = "projeto";
        $this->generic = new generic_dao($this->path, $this->class); // composição
	}

    function cadastrar (projeto $obj) {
        return $this->generic->cadastrar($obj->jsonSerialize());
    }

    function atualizar (projeto $obj) {
        return $this->generic->atualizar($obj->jsonSerialize());
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