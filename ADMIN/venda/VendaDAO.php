<?php
require_once 'DatabaseMySQL.php';
require_once 'Venda.php';

class VendaDAO {
    private $conexao;

    public function __construct() {
        $db = new DatabaseMySQL();
        $this->conexao = $db->conectar();
    }

    public function inserir(Venda $venda) {
        $sql = "INSERT INTO Venda (cliente_id, funcionario_id, servico_id, observacoes) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("iiis",
            $venda->getClienteId(),
            $venda->getFuncionarioId(),
            $venda->getServicoId(),
            $venda->getObservacoes()
        );
        return $stmt->execute();
    }

    public function listar() {
        $sql = "SELECT v.id, c.nome AS cliente, f.nome AS funcionario, s.nome AS servico, v.data_venda, v.observacoes
                FROM Venda v
                JOIN Cliente c ON v.cliente_id = c.id
                JOIN Funcionario f ON v.funcionario_id = f.id
                JOIN Servico s ON v.servico_id = s.id
                ORDER BY v.data_venda DESC";
        $result = $this->conexao->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM Venda WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function atualizar(Venda $venda) {
        $sql = "UPDATE Venda SET cliente_id = ?, funcionario_id = ?, servico_id = ?, observacoes = ?
                WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("iiisi",
            $venda->getClienteId(),
            $venda->getFuncionarioId(),
            $venda->getServicoId(),
            $venda->getObservacoes(),
            $venda->getId()
        );
        return $stmt->execute();
    }

    public function excluir($id) {
        $sql = "DELETE FROM Venda WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function __destruct() {
        $this->conexao->close();
    }
}
?>
