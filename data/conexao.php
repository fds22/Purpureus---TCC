<?php
function conectarBanco() {
    // Dados de conexão MySQL
    $servidor = "localhost";
    $usuario = "root";
    $senha = "1234";
    $banco = "fatec";

    // Criando a conexão
    $conexao = new mysqli($servidor, $usuario, $senha, $banco);

    // Verificando a conexão
    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

    return $conexao;
}
?>