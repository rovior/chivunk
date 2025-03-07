<?php

function exibirTabelaClientes($resultado) {
    echo "<div class='col-10 tabelaClientes'>";
    echo "<table class='col-12 table table-primary'>";
    echo "<caption>Clientes Cadastrados</caption>";
    echo "<thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Celular</th>
            <th>Código</th>
            <th>Data</th>
        </tr>
    </thead>";
    echo "<tbody>";
    
    while ($registro = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$registro['ID']}</td>";
        echo "<td>{$registro['NOME']}</td>";
        echo "<td>{$registro['EMAIL']}</td>";
        echo "<td>{$registro['CELULAR']}</td>";
        echo "<td>{$registro['CODIGO']}</td>";
        echo "<td>{$registro['DATA']}</td>";
        echo "</tr>";
    }
    
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
}

function buscarClientes($conexao, $NomeDaTabela1, $condicao = "") {
    $sql = "SELECT * FROM $NomeDaTabela1" . ($condicao ? " WHERE $condicao" : "");
    $resultado = $conexao->query($sql) OR exit($conexao->error);
    exibirTabelaClientes($resultado);
}

function clientesComCelular($conexao, $NomeDaTabela1) {
    buscarClientes($conexao, $NomeDaTabela1, "CELULAR IS NOT NULL");
}

function clientesComEmails($conexao, $NomeDaTabela1) {
    buscarClientes($conexao, $NomeDaTabela1, "EMAIL IS NOT NULL");
}

function clientesSemCelular($conexao, $NomeDaTabela1) {
    buscarClientes($conexao, $NomeDaTabela1, "CELULAR IS NULL");
}

function clientesSemEmails($conexao, $NomeDaTabela1) {
    buscarClientes($conexao, $NomeDaTabela1, "EMAIL IS NULL");
}

function todosClientes($conexao, $NomeDaTabela1) {
    buscarClientes($conexao, $NomeDaTabela1);
}

function todosClientesComEmailECelular($conexao, $NomeDaTabela1) {
    buscarClientes($conexao, $NomeDaTabela1, "EMAIL IS NOT NULL AND CELULAR IS NOT NULL");
}

?>
