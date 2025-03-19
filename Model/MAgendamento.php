<?php

class MAgendamento {
    private $agen_id;
    private $agen_idtipo;
    private $agen_idequip;
    private $agen_prof;
    private $agen_data;
    private $agen_idaulainicio;
    private $agen_idaulafim;
    private $agen_obs;
    
    
    
    public function __construct($agen_id,  $agen_idtipo, $agen_idequip, $agen_prof, $agen_data, $agen_idaulainicio, $agen_idaulafim, $agen_obs)
    {
       $this->agen_id = $agen_id;
       $this->agen_idtipo = $agen_idtipo;
       $this->agen_idequip = $agen_idequip;
       $this->agen_prof = $agen_prof;
       $this->agen_data = $agen_data;
       $this->agen_idaulainicio = $agen_idaulainicio;
       $this->agen_idaulafim = $agen_idaulafim;
       $this->agen_obs = $agen_obs;
       
      
    }

    public function setId($agen_id){
        $this->agen_id = $agen_id;
    }
    public function setIdTipo($agen_idtipo){
        $this->agen_idtipo = $agen_idtipo;
    }
    public function setIdEquip($agen_idequip){
        $this->agen_idequip = $agen_idequip;
    }
    public function setProf($agen_prof){
        $this->agen_prof = $agen_prof;
    }
    public function setData($agen_data){
        $this->agen_data = $agen_data;
    }
    public function setIdAulaInicio($agen_idaulainicio){
        $this->agen_idaulainicio = $agen_idaulainicio;
    }
    public function setIdAulaFim($agen_idaulafim){
        $this->agen_idaulafim = $agen_idaulafim;
    }
    public function setObs($agen_obs){
        $this->agen_obs = $agen_obs;
    }

   

    public function getId(){
        return $this->agen_id;
    }
    public function getIdTipo(){
        return $this->agen_idtipo;
    }
    public function getIdEquip(){
        return $this->agen_idequip;
    }
    public function getProf(){
        return $this->agen_prof;
    }
    public function getData(){
        return $this->agen_data;
    }
    public function getIdAulaInicio(){
        return $this->agen_idaulainicio;
    }
    public function getIdAulaFim(){
        return $this->agen_idaulafim;
    }
    public function getObs(){
        return $this->agen_obs;
    }
    
   
    
}


?>