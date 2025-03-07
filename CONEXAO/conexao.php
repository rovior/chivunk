<?php

class Conexao {

  private static $conexao;
  const NOME_BANCO = "site_lease";
  const NOME_TABELA_CLIENTE = "dados_cliente";
  const NOME_TABELA_FUNCIONARIO = "dados_funcionario";
  const NOME_TABELA_SERVICO = "dados_servico";
  const NOME_TABELA_VENDA = "dados_venda";

  public function __construct() {}

  public static function getConexao() {
    if (!isset(self::$conexao)) {
      $servidor = "localhost";
      $usuario  = "root";
      $senha    = "";

      // Estabelecendo a conexão com o servidor
      self::$conexao = new mysqli($servidor, $usuario, $senha);

      // Verificar se a conexão foi bem-sucedida
      if (self::$conexao->connect_error) {
          die("Conexão falhou: " . self::$conexao->connect_error);
      }

      // Criar banco de dados apenas se não existir
      $sql = "CREATE DATABASE IF NOT EXISTS " . self::NOME_BANCO . " CHARACTER SET utf8 COLLATE utf8_general_ci";
      if (!self::$conexao->query($sql)) {
          die("Erro ao criar banco de dados: " . self::$conexao->error);
      }

      echo "Banco de dados verificado/criado com sucesso!<br>";

      // Selecionar o banco de dados
      self::$conexao->select_db(self::NOME_BANCO);
      
      // Definir charset para a conexão
      self::$conexao->set_charset("utf8");
    }

    return self::$conexao;
  }

  public static function fecharStatement($stmt) {
    if ($stmt instanceof mysqli_stmt) {
      $stmt->close();
    }
  }

  public static function fecharResult($result) {
    if ($result instanceof mysqli_result) {
      $result->free();
    }
  }

  public static function fecharConexao() {
    if (isset(self::$conexao)) {
      self::$conexao->close();
    }
  }
}
