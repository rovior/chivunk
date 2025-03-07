<?php
include 'Funcionario.php';
include 'FuncionarioDAO.php';

// Dados do novo funcionário
$nome = 'João Silva';
$cpf = '12345678900';
$telefone = '999999999';
$endereco = 'Rua das Flores, 123';
$numero = '10';
$bairro = 'Centro';
$email = 'joao@exemplo.com';
$funcao = 'Analista';
$cidade = 'Florianopolis';

// Criação do objeto Funcionario
$funcionario = new Funcionario(null, $nome, $cpf, $telefone, $endereco, $numero, $bairro, $email, $funcao, $cidade_id);

// Inserir no banco
$conn = new mysqli('localhost', 'root', '', 'meubanco');
$dao = new FuncionarioDAO($conn);
$id = $dao->adicionarFuncionario($funcionario->getNome(), $funcionario->getCpf(), $funcionario->getTelefone(), $funcionario->getEndereco(), $funcionario->getNumero(), $funcionario->getBairro(), $funcionario->getEmail(), $funcionario->getFuncao(), $funcionario->getCidadeId());

if ($id) {
    echo "Funcionário adicionado com ID: $id";
} else {
    echo "Erro ao adicionar funcionário.";
}
?>
