<?php
require_once 'Venda.php';
require_once 'VendaDAO.php';

class VendaController {
    private $vendaDAO;

    public function __construct() {
        $this->vendaDAO = new VendaDAO();
    }

    //  Cadastrar nova venda
    public function inserirVenda($clienteId, $funcionarioId, $servicoId, $observacoes) {
        $venda = new Venda($clienteId, $funcionarioId, $servicoId, $observacoes);
        return $this->vendaDAO->inserir($venda);
    }

    // Listar todas as vendas
    public function listarVendas() {
        return $this->vendaDAO->listar();
    }

    // Buscar uma venda por ID
    public function buscarVendaPorId($id) {
        return $this->vendaDAO->buscarPorId($id);
    }

    // Atualizar uma venda existente
    public function atualizarVenda($id, $clienteId, $funcionarioId, $servicoId, $observacoes) {
        $venda = new Venda($clienteId, $funcionarioId, $servicoId, $observacoes, $id);
        return $this->vendaDAO->atualizar($venda);
    }

    //  Excluir uma venda
    public function excluirVenda($id) {
        return $this->vendaDAO->excluir($id);
    }

    // Listar Clientes, Funcionários e Serviços para os Selects
    public function listarClientes() {
        return $this->vendaDAO->listarClientes();
    }

    public function listarFuncionarios() {
        return $this->vendaDAO->listarFuncionarios();
    }

    public function listarServicos() {
        return $this->vendaDAO->listarServicos();
    }
}
?>
