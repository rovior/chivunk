<?php
session_start(); // INICIANDO A SESSÃO

if (!empty($_POST['opcao'])) {
    $_SESSION['opcao_selecionada'] = htmlspecialchars($_POST['opcao']);
}

require "./../CONEXAO/conexao.php";
require "./../INCLUDES/criar-tabela.inc.php";
require "./../INCLUDES/clientes-mok.inc.php";

if (isset($_POST["enviar"])) {
    $conexao = Conexao::getConexao();
}
?>