<?php

require_once __DIR__ . "/../model/usuario/usuario_dao.php";

class usuario_control {
    protected $obj;
    protected $obj_dao;

    public function __construct ($obj = NULL) {
        $this->objDAO = new usuario_dao();
        $this->obj = $obj;
    }

    function cadastrar () {
        $o = new usuario();
        $o->setID($this->obj['id']);
        if (!empty($this->obj['nome'])) $o->setNome($this->obj['nome']);
        if (!empty($this->obj['celular1'])) $o->setCelular1($this->obj['celular1']);
        if (!empty($this->obj['celular2'])) $o->setCelular2($this->obj['celular2']);
        if (!empty($this->obj['email'])) $o->setEmail($this->obj['email']);
        if (!empty($this->obj['senha'])) $o->setSenha($this->obj['senha']);
        $o->setData_cadastro(date('Y-m-d H:i:s'));

        return $this->objDAO->cadastrar($o);
    }

    function atualizar () {

        $o = new usuario();
        $o->setId($this->obj['id']);
        if (!empty($this->obj['nome'])) $o->setNome($this->obj['nome']);
        if (!empty($this->obj['celular1'])) $o->setCelular1($this->obj['celular1']);
        if (!empty($this->obj['celular2'])) $o->setCelular2($this->obj['celular2']);
        if (!empty($this->obj['email'])) $o->setEmail($this->obj['email']);
        if (!empty($this->obj['senha'])) $o->setSenha($this->obj['senha']);
        $o->setUltimo_acesso(date('Y-m-d H:i:s'));
        if (!empty($this->obj['data_cadastro'])) $o->setData_cadastro($this->obj['data_cadastro']);
        $o->setData_edicao(date('Y-m-d H:i:s'));

        return $this->objDAO->atualizar($o);
    }

    function listar () {
        return $this->objDAO->listar();
    }
}

?>