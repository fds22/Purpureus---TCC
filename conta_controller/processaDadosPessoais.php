<?php
session_start();
require_once '../data/conexao.php';

// Verifica se o usuário está logado
if(!isset($_SESSION['usuario_id'])) {
    header("Location: ../login/login.php");
    exit();
}

// Conexão com o banco de dados
$conexao = conectarBanco();

// Busca os dados atuais do usuário
$sql = "SELECT * FROM usuario WHERE idUsuario = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $_SESSION['usuario_id']);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coleta os dados do formulário
    $nome = $_POST['nome'] ?? $usuario['nome'];
    $sobrenome = $_POST['sobrenome'] ?? $usuario['sobrenome'];
    $email = $_POST['email'] ?? $usuario['email'];
    
    // Verifica se a senha foi alterada
    $senha = $usuario['senha'];
    if (!empty($_POST['senha'])) {
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    }

    // Atualiza no banco de dados
    $sql_update = "UPDATE usuario SET 
                  nome = ?, 
                  sobrenome = ?, 
                  email = ?, 
                  senha = ? 
                  WHERE idUsuario = ?";
    
    $stmt_update = $conexao->prepare($sql_update);
    $stmt_update->bind_param("ssssi", $nome, $sobrenome, $email, $senha, $_SESSION['usuario_id']);
    
    if ($stmt_update->execute()) {
        $_SESSION['mensagem_sucesso'] = "Dados atualizados com sucesso!";
        header("Location: conta.php");
        exit();
    } else {
        $_SESSION['mensagem_erro'] = "Erro ao atualizar dados: " . $conexao->error;
    }
}
?>