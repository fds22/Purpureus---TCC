<?php
require_once '../../data/conexao.php';

$idProduto = 3; // Produto fixo

$conexao = conectarBanco();



$sql = "SELECT imagemProd FROM produto WHERE idProduto = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param('i', $idProduto);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    die('Produto não encontrado');
}

$stmt->bind_result($imagemProd);
$stmt->fetch();

if ($imagemProd === null) {
    die('Produto não possui imagem');
}

header("Content-Type: image/jpeg"); // Ajuste conforme o tipo da imagem
echo $imagemProd;

$stmt->close();
$conexao->close();
?>
