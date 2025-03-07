<?php

require_once '../INCLUDES/conectar.inc.php';
require_once 'Cliente.php';

class ClienteDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function inserir(Cliente $cliente) {
        $sql = "INSERT INTO clientes (nome, telefone, email, servico) VALUES (:nome, :telefone, :email, :servico)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $cliente->getNome());
        $stmt->bindValue(':telefone', $cliente->getTelefone());
        $stmt->bindValue(':email', $cliente->getEmail());
        $stmt->bindValue(':servico', $cliente->getServico());
        return $stmt->execute();
    }

    public function listar() {
        $sql = "SELECT * FROM clientes";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM clientes WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($dados) {
            return new Cliente($dados['nome'], $dados['telefone'], $dados['email'], $dados['servico'], $dados['id']);
        }
        return null;
    }

    public function atualizar(Cliente $cliente) {
        $sql = "UPDATE clientes SET nome = :nome, telefone = :telefone, email = :email, servico = :servico WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $cliente->getNome());
        $stmt->bindValue(':telefone', $cliente->getTelefone());
        $stmt->bindValue(':email', $cliente->getEmail());
        $stmt->bindValue(':servico', $cliente->getServico());
        $stmt->bindValue(':id', $cliente->getId());
        return $stmt->execute();
    }

    public function deletar($id) {
        $sql = "DELETE FROM clientes WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}

?>
