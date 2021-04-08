<?php

class usuario implements JsonSerializable {
    private $id;
    private $nome;
    private $celular1;
    private $celular2;
    private $email;
    private $senha;
    private $ultimo_acesso;
    private $data_cadastro;
    private $data_edicao;

    public function __construct (
        $id = "",
        $nome = "",
        $celular1 = "",
        $celular2 = "",
        $email = "",
        $senha = "",
        $ultimo_acesso = "",
        $data_cadastro = "",
        $data_edicao = ""
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->celular1 = $celular1;
        $this->celular2 = $celular2;
        $this->email = $email;
        $this->senha = $senha;
        $this->ultimo_acesso = $ultimo_acesso;
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
    public function getCelular1() {
        return $this->celular1;
    }
    public function getCelular2() {
        return $this->celular2;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getSenha() {
        return $this->senha;
    }
    public function getUltimo_acesso() {
        return $this->ultimo_acesso;
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
    public function setCelular1($celular1) {
        $this->celular1 = $celular1;
        return $this;
    }
    public function setCelular2($celular2) {
        $this->celular2 = $celular2;
        return $this;
    }
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }
    public function setSenha($senha) {
        $this->senha = $senha;
        return $this;
    }
    public function setUltimo_acesso($ultimo_acesso) {
        $this->ultimo_acesso = $ultimo_acesso;
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
            "celular1" => $this->celular1,
            "celular2" => $this->celular2,
            "email" => $this->email,
            "senha" => $this->senha,
            "ultimo_acesso" => $this->ultimo_acesso,
            "data_cadastro" => $this->data_cadastro,
            "data_edicao" => $this->data_edicao
        ];
    }
}

?>