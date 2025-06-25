<?php
session_start();
require_once '../data/conexao.php';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$conexao = conectarBanco();

// Busca o usuário apenas pelo email
$sql = "SELECT idUsuario, nome, senha FROM usuario WHERE email = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    $hashSalvo = $usuario['senha'];

    // Verifica se a senha digitada corresponde ao hash salvo
    if (password_verify($senha, $hashSalvo)) {
        // Login OK
        $_SESSION['usuario_id'] = $usuario['idUsuario'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        header("Location: ../html/index.php");
        exit();
    } else {
        // Senha incorreta
        $_SESSION['erro_login'] = "Email ou senha incorretos!";
        header("Location: login.php");
        exit();
    }
} else {
    // Email não encontrado
    $_SESSION['erro_login'] = "Email ou senha incorretos!";
    header("Location: login.php");
    exit();
}
?>