<?php

class Cliente {
    private $id;
    private $nome;
    private $telefone;
    private $email;
    private $servico;

    public function __construct($nome, $telefone, $email, $servico, $id = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->servico = $servico;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getServico() {
        return $this->servico;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setServico($servico) {
        $this->servico = $servico;
    }
}

?>
