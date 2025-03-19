<?php

class MUsuario {
    private $usu_id;
    private $usu_nome;
    private $usu_email;
    private $usu_login;
    private $usu_senha;
    private $usu_nivel;

    public function __construct($usu_id, $usu_nome, $usu_email, $usu_login, $usu_senha, $usu_nivel){
        $this->usu_id = $usu_id;
        $this->usu_nome = $usu_nome;
        $this->usu_email = $usu_email;
        $this->usu_login = $usu_login;
        $this->usu_senha = $usu_senha;
        $this->usu_nivel = $usu_nivel;
    }

    public function setId($usu_id) {
        $this->usu_id = $usu_id;
    }

    public function setNome($usu_nome) {
        $this->usu_nome = $usu_nome;
    }

    public function setEmail($usu_email) {
        $this->usu_email = $usu_email;
    }

    public function setLogin($usu_login) {
        $this->usu_login = $usu_login;
    }

    public function setSenha($usu_senha) {
        $this->usu_senha = $usu_senha;
    }
    public function setNivel($usu_nivel) {
        $this->usu_nivel = $usu_nivel;
    }


    public function getId(){
        return $this->usu_id;
    }
    public function getNome(){
        return $this->usu_nome;
    }
    public function getEmail(){
        return $this->usu_email;
    }
    public function getLogin(){
        return $this->usu_login;
    }
    public function getSenha(){
        return $this->usu_senha;
    }
    public function getNivel(){
        return $this->usu_nivel;
    }
}


?>