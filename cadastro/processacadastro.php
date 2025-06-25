<?php
session_start();
require_once '../data/conexao.php';

// *Verifica se os dados foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['nome'] ?? ''); // *trim remove espaços em branco do início e do fim da string
    $sobrenome = trim($_POST['sobrenome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
    $confirmar_senha = trim($_POST['confirmar_senha'] ?? '');

    if ($senha !== $confirmar_senha) {
        $_SESSION['cadastro_erro'] = "As senhas não coincidem. Por favor, digite a mesma senha nos dois campos.";
        header("Location: cadastro.php");
        exit();
    }


    $conexao = conectarBanco();

    // *Verifica se o email já esta cadastrado
    $sql = "SELECT * FROM usuario WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $_SESSION['cadastro_erro'] = "Este email já está cadastrado.";
        header("Location: cadastro.php");
        exit();
    }
    $stmt ->close();

    // *Hash da senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // *Insere o novo usuário
    $sql = "INSERT INTO usuario (nome, sobrenome, email, senha) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssss", $name, $sobrenome, $email, $senhaHash);

    if ($stmt->execute()) {
        $_SESSION['cadastro_sucesso'] = "Cadastro realizado com sucesso!";
        header("Location: ../login/login.php");
        exit();
    } else {
        // Ver o erro específico do MySQL
        error_log("Erro MySQL: " . $stmt->error);
        $_SESSION['cadastro_erro'] = "Erro ao cadastrar. Por favor, tente novamente. Erro: " . $stmt->error;
        header("Location: cadastro.php");
        exit();
    }
} else {
    header("Location: cadastro.php");
    exit();
}