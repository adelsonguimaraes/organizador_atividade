<?php

require_once __DIR__ . "/../model/projeto/projeto_dao.php";

class projeto_control {
    protected $obj;
    protected $obj_dao;

    public function __construct ($obj = NULL) {
        $this->objDAO = new projeto_dao();
        $this->obj = $obj;
    }

    function cadastrar () {
        $o = new projeto();
        $o->setID($this->obj['id']);
        if (!empty($this->obj['nome'])) $o->setNome($this->obj['nome']);
        if (!empty($this->obj['descricao'])) $o->setDescricao($this->obj['descricao']);
        if (!empty($this->obj['ativo'])) $o->setAtivo($this->obj['ativo']);
        $o->setData_cadastro(date('Y-m-d H:i:s'));

        return $this->objDAO->cadastrar($o);
    }

    function atualizar () {

        $o = new projeto();
        $o->setId($this->obj['id']);
        if (!empty($this->obj['nome'])) $o->setNome($this->obj['nome']);
        if (!empty($this->obj['descricao'])) $o->setDescricao($this->obj['descricao']);
        if (!empty($this->obj['ativo'])) $o->setAtivo($this->obj['ativo']);
        if (!empty($this->obj['data_cadastro'])) $o->setData_cadastro($this->obj['data_cadastro']);
        $o->setData_edicao(date('Y-m-d H:i:s'));
        
        return $this->objDAO->atualizar($o);
    }

    function listar () {
        return $this->objDAO->listar();
    }

    function remover ($id) {
        return $this->objDAO->remover($id);
    }
}

?>