<?php

class Funcionario {

    private $id;
    private $nome;
    private $cpf;
    private $telefone;
    private $endereco;
    private $numero;
    private $bairro;
    private $email;
    private $funcao;
    private $cidade;

    // Construtor
    public function __construct($id = null, $nome, $cpf, $telefone, $endereco, $numero, $bairro, $email, $funcao, $cidade) {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->telefone = $telefone;
        $this->endereco = $endereco;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->email = $email;
        $this->funcao = $funcao;
        $this->cidade_id = $cidade;
    }

    // Getters e setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getFuncao() {
        return $this->funcao;
    }

    public function setFuncao($funcao) {
        $this->funcao = $funcao;
    }

    public function getCidadeId() {
        return $this->cidade;
    }

    public function setCidadeId($cidade) {
        $this->cidade = $cidade
    }

    // Método para converter o objeto para array
    public function toArray() {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'telefone' => $this->telefone,
            'endereco' => $this->endereco,
            'numero' => $this->numero,
            'bairro' => $this->bairro,
            'email' => $this->email,
            'funcao' => $this->funcao,
            'cidade_id' => $this->cidade
        ];
    }

    // Método para exibir os dados como uma string
    public function __toString() {
        return "Funcionario [ID: $this->id, Nome: $this->nome, CPF: $this->cpf]";
    }
}

?>
