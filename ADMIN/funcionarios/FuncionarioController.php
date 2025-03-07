<?php
include 'FuncionarioDAO.php';

class FuncionarioController {

    private $dao;

    public function __construct($conn) {
        $this->dao = new FuncionarioDAO($conn);
    }

    // Listar funcionários
    public function listarFuncionarios() {
        return $this->dao->listarFuncionarios();
    }

    // Remover um funcionário
    public function removerFuncionario($id) {
        return $this->dao->removerFuncionario($id);
    }

    // Buscar um funcionário
    public function buscarFuncionario($id) {
        return $this->dao->buscarFuncionarioPorId($id);
    }

    // Atualizar um funcionário
    public function atualizarFuncionario($id, $nome, $cpf, $telefone, $endereco, $numero, $bairro, $email, $funcao, $cidade_id) {
        return $this->dao->atualizarFuncionario($id, $nome, $cpf, $telefone, $endereco, $numero, $bairro, $email, $funcao, $cidade_id);
    }

    // Adicionar um funcionário
    public function adicionarFuncionario($nome, $cpf, $telefone, $endereco, $numero, $bairro, $email, $funcao, $cidade_id) {
        return $this->dao->adicionarFuncionario($nome, $cpf, $telefone, $endereco, $numero, $bairro, $email, $funcao, $cidade_id);
    }
}
?>
