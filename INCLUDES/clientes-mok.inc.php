<?php

$conexao = Conexao::getConexao();

// Array de clientes mockados
$clientes = [
  ["João Silva", "joao.silva@email.com", "11987654321", "A1B2C3"],
  ["Maria Oliveira", "maria.oliveira@email.com", "11998765432", "X3Y4Z5"],
  ["Carlos Santos", "carlos.santos@email.com", "11876543210", "L9M8N7"],
  ["Ana Souza", "ana.souza@email.com", null, "P2Q3R4"],
  ["Bruno Costa", "bruno.costa@email.com", "11954321098", "D5E6F7"],
  ["Fernanda Lima", "fernanda.lima@email.com", null, "G7H8I9"],
  ["Pedro Henrique", "pedro.henrique@email.com", "11911112222", "J1K2L3"],
  ["Amanda Torres", "amanda.torres@email.com", null, "M4N5O6"],
  ["Ricardo Mendes", "ricardo.mendes@email.com", "11933334444", "P7Q8R9"],
  ["Juliana Alves", "juliana.alves@email.com", null, "S1T2U3"],
  ["Lucas Martins", "lucas.martins@email.com", "11955556666", "V4W5X6"],
  ["Beatriz Rocha", "beatriz.rocha@email.com", null, "Y7Z8A9"],
  ["Felipe Souza", "felipe.souza@email.com", "11977778888", "B1C2D3"],
  ["Isabela Nogueira", "isabela.nogueira@email.com", "11988889999", "E4F5G6"],
  ["Gustavo Carvalho", "gustavo.carvalho@email.com", null, "H7I8J9"],
  ["Vanessa Pereira", "vanessa.pereira@email.com", "11900001111", "K1L2M3"],
  ["Thiago Almeida", "thiago.almeida@email.com", null, "N4O5P6"],
  ["Patrícia Ramos", "patricia.ramos@email.com", "11922223333", "Q7R8S9"],
  ["Leonardo Freitas", "leonardo.freitas@email.com", null, "T1U2V3"],
  ["Camila Barros", "camila.barros@email.com", "11944445555", "W4X5Y6"]
];

$stmt = $conexao->prepare("INSERT IGNORE INTO " . Conexao::NOME_TABELA_CLIENTE ." (NOME, EMAIL, CELULAR, CODIGO) VALUES (?, ?, ?, ?)");

if ($stmt === false) {
  die("Erro ao preparar a consulta: " . $conexao->error);
}

foreach ($clientes as $cliente) {
  $stmt->bind_param("ssss", $cliente[0], $cliente[1], $cliente[2], $cliente[3]);

  if (!$stmt->execute()) {
    echo "Erro ao inserir cliente: " . $stmt->error . "<br>";
  }
}

Conexao::fecharStatement($stmt);
Conexao::fecharConexao();

echo "Clientes mockados inseridos com sucesso!<br>";