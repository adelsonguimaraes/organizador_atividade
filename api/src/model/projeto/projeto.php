<?php

class projeto implements JsonSerializable {
    private $id;
    private $nome;
    private $descricao;
    private $ativo;
    private $data_cadastro;
    private $data_edicao;

    public function __construct (
        $id = "",
        $nome = "",
        $descricao = "",
        $ativo = "",
        $data_cadastro = "",
        $data_edicao = ""
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->ativo = $ativo;
        $this->data_cadastro = $data_cadastro;
        $this->data_edicao = $data_edicao;
    }

    // gets
    public function getId() {
        return $this->id;
    }
    public function getNome() {
        return $this->nome;
    }
    public function getDescricao() {
        return $this->descricao;
    }
    public function getAtivo() {
        return $this->ativo;
    }
    public function getData_cadastro() {
        return $this->data_cadastro;
    }
    public function getData_edicao() {
        return $this->data_edicao;
    }

    // sets
    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }
    public function setAtivo($ativo) {
        $this->ativo = $ativo;
        return $this;
    }
    public function setData_cadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
        return $this;
    }
    public function setData_edicao($data_edicao) {
        $this->data_edicao = $data_edicao;
        return $this;
    }

    public function jsonSerialize () {
        return [
            "id" => $this->id,
            "nome" => $this->nome,
            "descricao" => $this->descricao,
            "ativo" => $this->ativo,
            "data_cadastro" => $this->data_cadastro,
            "data_edicao" => $this->data_edicao
        ];
    }
}

?>