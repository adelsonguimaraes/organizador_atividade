<?php

require_once __DIR__ . "/../generic/generic_dao.php";

// dao ajuda
class ajuda_dao {
    private $path = "";
    private $generic = null;
    private $class = "";

    //construtor
	public function __construct() {
        $this->path = "rpg-help.json";
        $this->class = "ajuda";
        $this->generic = new generic_dao($this->path, $this->class); // composição
	}

    function cadastrar ($obj) {
        return $this->generic->cadastrar(
            array(
                "id"=> "",
                "ajuda"=> $obj['ajuda'],
                "descricao"=> $obj['descricao']
            )
        );
    }

    function atualizar ($obj) {
        return $this->generic->atualizar(
            array(
                "id"=> intval($obj['id']),
                "ajuda"=> $obj['ajuda'],
                "descricao"=> $obj['descricao']
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