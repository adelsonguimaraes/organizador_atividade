<?php

// dao item
class generic_dao {
    private $path = "";
    private $class = "";

    //construtor
	public function __construct($path, $class) {
        $this->path = __DIR__ . "/../../../db/" . $path;
        $this->class = $class;
	}

    function readFile ($metodo) {
        $response = array("success"=>true, "msg"=>"", "data"=>"");
        $result = @file_get_contents($this->path);

        if($result===false) {
            $response['success'] = false;
            $response['msg'] = "['ERRO'][$metodo]: O arquivo $this->path não foi localizado!";            
        }else{
            $response['success'] = true;
            $lista = json_decode($result, true);
            if (empty($lista)) $lista = array(); // se a lista estiver nula
            $response['data'] = $lista;
        }

        return $response;
    }

    function writeFile ($data, $metodo) {
        $response = array("success"=>true, "msg"=>"", "data"=>"");
        $result = @file_put_contents($this->path, json_encode($data, JSON_PRETTY_PRINT));
        if (!$result) {
            $response['success'] = false;
            $response['msg'] = "['ERRO']['$metodo']: Erro ao escrever o arquivo";
        }else{
            $response['success'] = true;
            $response['data'] = true;
        }
        return $response;
    }

    function clean () {
        return $resp = $this->writeFile('', "{$this->class}::clean");
    }

    function cadastrar ($obj) {
        $response = array("success"=>true, "msg"=>"", "data"=>"");

        $resp = $this->readFile("{$this->class}:cadastrar");
        if (!$resp['success']) return $resp;

        $lista = $resp['data'];

        // incrementa ID
        $id = 0;
        if (!empty($lista)) {
            $id = $lista[count($lista)-1]['id'] + 1;
        }else{
            $id = 1;
        }
        
        $obj['id'] = $id;

        array_push($lista, $obj);

        $resp = $this->writeFile ($lista, "{$this->class}:cadastrar");
        if (!$resp['success']) return $resp;

        $response['success'] = true;
        $response['data'] = $id;

        return $response;
    }

    function atualizar ($obj) {
        $response = array("success"=>true, "msg"=>"", "data"=>"");

        $resp = $this->readFile("{$this->class}:atualizar");
        if (!$resp['success']) return $resp;

        $lista = $resp['data'];
        
        $array = array();
        foreach ($lista as $key) {
            if (intval($key['id']) !== intval($obj['id'])) {
                array_push($array, $key);
            }else{
                array_push($array, $obj);
            }
        }

        $resp = $this->writeFile ($array, "{$this->class}:atualizar");
        if (!$resp['success']) return $resp;

        $respose['success'] = true;
        $respose['data'] = true;

        return $response;
    }

    function buscarPorId ($id) {
        $response = array("success"=>true, "msg"=>"", "data"=>"");

        $resp = $this->readFile("{$this->class}:listar");
        if (!$resp['success']) return $resp;
        $lista = $resp['data'];

        $result = null;
        foreach($lista as $key) {
            if (intval($key['id']) === intval($id)) {
                $result = $key;
            }
        }

        $response['success'] = true;
        $response['data'] = $result;
        
        return $response;
    }

    function listar () {
        $resp = $this->readFile("{$this->class}:listar");
        return $resp;
    }

    function remover ($id) {
        $response = array("success"=>true, "msg"=>"", "data"=>"");

        $resp = $this->readFile("{$this->class}:deletar");
        if (!$resp['success']) return $resp;

        $lista = $resp['data'];
        
        $array = array();
        foreach ($lista as $key) {
            if (intval($key['id']) !== intval($id)) {
                array_push($array, $key);
            }
        }

        $resp = $this->writeFile ($array, "{$this->class}:deletar");
        if (!$resp['success']) return $resp;

        $respose['success'] = true;
        $respose['data'] = true;

        return $response;
    }
}

?>