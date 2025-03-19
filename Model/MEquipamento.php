<?php

class MEquipamento {
    private $equ_id;
    private $equ_tipoid;
    private $equ_nome;
    private $equ_obs;

    public function __construct($equ_id, $equ_tipoid, $equ_nome, $equ_obs){
        $this->equ_id=$equ_id;
        $this->equ_tipoid=$equ_tipoid;
        $this->equ_nome=$equ_nome;
        $this->equ_obs=$equ_obs;
    }

    public function setId($equ_id){
        $this->equ_id=$equ_id;
    }

    public function setTipoId($equ_tipoid){
        $this->equ_tipoid=$equ_tipoid;
    }

    public function setNome($equ_nome){
        $this->equ_nome=$equ_nome;
    }
    public function setObs($equ_obs){
        $this->equ_obs=$equ_obs;
    }

    public function getId(){
        return $this->equ_id;
    }

    public function getTipoId(){
        return $this->equ_tipoid;
    }

    public function getNome(){
        return $this->equ_nome;
    }
    public function getObs(){
        return $this->equ_obs;
    }


}



?>