<?php
  // Criar banco de dados apenas se não existir
  $sql = "CREATE DATABASE IF NOT EXISTS " . self::NOME_BANCO ;
  if (!self::$conexao->query($sql)) {
      die("Erro ao criar banco de dados: " . self::$conexao->error);
  }

  echo "Banco de dados verificado/criado com sucesso!<br>";

  // Selecionar o banco de dados
  self::$conexao->select_db(self::NOME_BANCO);
  
  // Definir charset para a conexão
  self::$conexao->set_charset("utf8");