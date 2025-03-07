<?php
include 'conexao.php';

class FuncionarioDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Listar todos os funcionários
    public function listarFuncionarios() {
        $sql = "SELECT f.*, c.nome AS cidade_nome FROM funcionarios f JOIN cidades c ON f.cidade_id = c.id";
        $result = $this->conn->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC); // Retorna todos os funcionários como array associativo
    }

    // Remover um funcionário
    public function removerFuncionario($id) {
        $sql = "DELETE FROM funcionarios WHERE id = ?";
        
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return $stmt->affected_rows > 0; // Retorna true se o funcionário foi removido
        }

        return false;
    }

    // Buscar um funcionário por ID
    public function buscarFuncionarioPorId($id) {
        $sql = "SELECT f.*, c.nome AS cidade_nome FROM funcionarios f JOIN cidades c ON f.cidade_id = c.id WHERE f.id = ?";
        
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc(); // Retorna o funcionário encontrado
        }

        return null;
    }

    // Atualizar um funcionário
    public function atualizarFuncionario($id, $nome, $cpf, $telefone, $endereco, $numero, $bairro, $email, $funcao, $cidade_id) {
        $sql = "UPDATE funcionarios SET nome = ?, cpf = ?, telefone = ?, endereco = ?, numero = ?, bairro = ?, email = ?, funcao = ?, cidade_id = ? WHERE id = ?";

        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("ssssssssi", $nome, $cpf, $telefone, $endereco, $numero, $bairro, $email, $funcao, $cidade_id, $id);
            $stmt->execute();
            return $stmt->affected_rows > 0; // Retorna true se o funcionário foi atualizado
        }

        return false;
    }

    // Adicionar um novo funcionário
    public function adicionarFuncionario($nome, $cpf, $telefone, $endereco, $numero, $bairro, $email, $funcao, $cidade_id) {
        $sql = "INSERT INTO funcionarios (nome, cpf, telefone, endereco, numero, bairro, email, funcao, cidade_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("ssssssssi", $nome, $cpf, $telefone, $endereco, $numero, $bairro, $email, $funcao, $cidade_id);
            $stmt->execute();
            return $stmt->insert_id; // Retorna o ID do novo funcionário
        }

        return null;
    }
}
?>
