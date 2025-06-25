<?php
session_start();
require_once '../../data/conexao.php';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$conexao = conectarBanco();

$sql = "SELECT idUsuario, nome, senha FROM usuario WHERE email = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();


if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    $hashSalvo = $usuario['senha'];

if ($email == 'adm@gmail.com' && password_verify($senha, $hashSalvo)) {
    $_SESSION['adm_id'] = $usuario['idUsuario'];
    $_SESSION['adm_nome'] = $usuario['nome'];
    header("Location: ../dashbord/dashbord.php");
    exit();
    }
} 

// *Erro - redireciona de volta com a mensagem de erro
$_SESSION['erro_login'] = "Email ou senha incorretos!";
header("Location: loginAdm.php");
exit();
?>