<?php
// Definindo o tipo de resposta como JSON
header('Content-Type: application/json');

// Verifica se o CEP foi passado por GET
if (!isset($_GET['cep'])) {
    echo json_encode(['erro' => 'CEP não informado']);
    exit;
}

$cep = preg_replace('/[^0-9]/', '', $_GET['cep']); // Remove caracteres não numéricos

// Verifica se o CEP tem 8 dígitos
if (strlen($cep) != 8) {
    echo json_encode(['erro' => 'CEP inválido']);
    exit;
}

// Faz a requisição para a API do ViaCEP
$url = "https://viacep.com.br/ws/$cep/json/";

$response = file_get_contents($url);

if ($response === FALSE) {
    echo json_encode(['erro' => 'Erro ao consultar o CEP']);
    exit;
}

$dados = json_decode($response, true);

if (isset($dados['erro']) && $dados['erro']) {
    echo json_encode(['erro' => 'CEP não encontrado']);
    exit;
}

echo $response;