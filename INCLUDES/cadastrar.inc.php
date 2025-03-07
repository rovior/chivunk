<?php

$conexao = Conexao::getConexao();

$_SESSION['codigo_autenticacao'] = $codigoGerado;

$nome     = $conexao->escape_string(trim($_POST["nome-do-usuario"]));
$email    = $conexao->escape_string(trim($_POST["email-do-usuario"]));
$celular  = $conexao->escape_string(trim($_POST["celular-do-usuario"]));

if(empty($celular)) {

  $sql = "INSERT IGNORE INTO " . Conexao::NOME_TABELA_CLIENTE . " ( NOME, EMAIL, CELULAR, CODIGO, DATA ) VALUES (?, ?, NULL, ?, DEFAULT)";
  $stmt = $conexao->prepare($sql);
  if($stmt) {
    $stmt->bind_param("sss", $nome, $email, $codigoGerado);
    $stmt->execute();
    // Verifica se houve erro na execução
    if ($stmt->affected_rows > 0) {
      echo "<p> Dados do Cliente ( $nome adicionados no banco com <br> <span class='sucesso'> SUCESSO! </span> </p>";
    } else {
      echo "<p> Não foi possível adicionar o cliente. Talvez o cliente já exista.</p>";
    }
  // Fecha o statement
  Conexao::fecharStatement($stmt);
  }
  else {
    exit("Erro na preparação da query: " . $conexao->error);
  }
}
else {
  $sql = "INSERT IGNORE INTO " . Conexao::NOME_TABELA_CLIENTE . " (NOME, EMAIL, CELULAR, CODIGO, DATA) VALUES (?, ?, ?, ?, DEFAULT)";
  
  $stmt = $conexao->prepare($sql);
  
  if ($stmt) {
    $stmt->bind_param("ssss", $nome, $email, $celular, $codigoGerado);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
      echo "<p> Dados do Cliente ( $nome, Cód: $codigoGerado ) adicionados no banco com <br> <span class='sucesso'> SUCESSO! </span> </p>";
    } else {
      echo "<p> Não foi possível adicionar o cliente. Talvez o cliente já exista.</p>";
    }
    
    Conexao::fecharStatement($stmt);
  } else {
    exit("Erro na preparação da query: " . $conexao->error);
  }
}