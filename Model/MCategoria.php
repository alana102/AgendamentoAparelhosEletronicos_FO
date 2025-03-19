<?php

class MCategoria {
    private $tipo_id;
    private $tipo_nome;

    public function __construct($tipo_id, $tipo_nome){
        $this->tipo_id=$tipo_id;
        $this->tipo_nome=$tipo_nome;
    }

    public function setId($tipo_id){
        $this->tipo_id=$tipo_id;
    }
    public function setNome($tipo_nome){
        $this->tipo_nome=$tipo_nome;
    }

    public function getId(){
        return $this->tipo_id;
    }
    public function getNome(){
        return $this->tipo_nome;
    }
}



?>