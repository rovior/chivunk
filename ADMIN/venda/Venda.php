<?php
class Venda {
    private $id;
    private $clienteId;
    private $funcionarioId;
    private $servicoId;
    private $dataVenda;
    private $observacoes;

    public function __construct($clienteId, $funcionarioId, $servicoId, $observacoes, $id = null) {
        $this->id = $id;
        $this->clienteId = $clienteId;
        $this->funcionarioId = $funcionarioId;
        $this->servicoId = $servicoId;
        $this->observacoes = $observacoes;
        $this->dataVenda = date('Y-m-d H:i:s'); 
    }

    public function getId() { return $this->id; }
    public function getClienteId() { return $this->clienteId; }
    public function getFuncionarioId() { return $this->funcionarioId; }
    public function getServicoId() { return $this->servicoId; }
    public function getDataVenda() { return $this->dataVenda; }
    public function getObservacoes() { return $this->observacoes; }
}
