<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Usuário não autenticado']);
    exit;
}
$usuario_id = $_SESSION['usuario_id'];

$json = file_get_contents('php://input');

$dados = json_decode($json, true);

if ($dados === null) {
    http_response_code(400);
    echo json_encode(["erro" => "JSON inválido"]);
    exit;
}


$nome_endereco = $dados['nome_endereco'];
$cep = $dados['cep'];
$rua = $dados['rua'];
$numero = $dados['numero'];
$complemento = $dados['complemento'];
$bairro = $dados['bairro'];
$cidade = $dados['cidade'];
$estado = $dados['estado'];
$principal = isset($dados['principal']) ? 1 : 0;

echo ("Seu endereço: $nome_endereco, $cep, $rua, $numero, $complemento, $bairro, $cidade, $estado, principal: $principal");

require_once '../data/conexao.php';
$conn = conectarBanco();

if ($principal) {
    $conn->query("UPDATE enderecos SET principal = 0 WHERE usuario_id = $usuario_id");
}

$stmt = $conn->prepare("INSERT INTO enderecos (usuario_id, nome_endereco, cep, rua, numero, complemento, bairro, cidade, estado, principal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssssssi", $usuario_id, $nome_endereco, $cep, $rua, $numero, $complemento, $bairro, $cidade, $estado, $principal);

if ($stmt->execute()) {
    echo "Endereço salvo com sucesso.";
} else {
    echo "Erro ao salvar.";
}

$stmt->close();
$conn->close();
?>
