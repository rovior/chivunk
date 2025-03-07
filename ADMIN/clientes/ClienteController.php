<?php
require_once 'ClienteDAO.php';
require_once 'Cliente.php';  // Adicionando a inclusão do modelo Cliente

class ClienteController {
    private $clienteDAO;

    // Injeção de dependência do ClienteDAO
    public function __construct(ClienteDAO $clienteDAO) {
        $this->clienteDAO = $clienteDAO;
    }

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validação de dados
            if (!isset($_POST['nome'], $_POST['telefone'], $_POST['email'], $_POST['opcao'])) {
                die('Erro: Dados inválidos!');
            }

            $cliente = new Cliente(
                $_POST['nome'],
                $_POST['telefone'],
                $_POST['email'],
                $_POST['opcao'],
                $_POST['id'] ?? null
            );

            // Inserir ou atualizar o cliente
            $sucesso = $this->clienteDAO->inserir($cliente);
            
            if ($sucesso) {
                header('Location: lista.html');
                exit;
            } else {
                die('Erro ao salvar os dados do cliente!');
            }
        }
    }

    public function listar() {
        return $this->clienteDAO->listar();
    }

    public function deletar($id) {
        $sucesso = $this->clienteDAO->deletar($id);
        
        if ($sucesso) {
            header('Location: lista.html');
            exit;
        } else {
            die('Erro ao deletar cliente!');
        }
    }
}

// index.php
require_once 'ClienteController.php';
require_once 'ClienteDAO.php';
require_once 'Cliente.php';

// Instanciando o ClienteDAO e passando para o Controller
$clienteDAO = new ClienteDAO($pdo);  // Supondo que você tenha uma variável $pdo de conexão
$controller = new ClienteController($clienteDAO);

if (isset($_GET['delete'])) {
    $controller->deletar($_GET['delete']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->salvar();
} else {
    $clientes = $controller->listar();
}
