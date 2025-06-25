<?php
header('Content-Type: application/json');

$cep = $_GET['cep'] ?? null;

// Verifica se o CEP foi informado
if (!isset($cep) || empty($cep)) {
    echo json_encode(['erro' => 'CEP não informado']);
    exit;
}

// Limpa o CEP, removendo qualquer caractere não numérico
$cep = preg_replace('/\D/', '', $cep);

// Valida o CEP (tem que ter 8 dígitos)
if (strlen($cep) != 8) {
    echo json_encode(['erro' => 'CEP inválido']);
    exit;
}

// Faz a requisição para a API do ViaCEP
$url = "https://viacep.com.br/ws/$cep/json/";

$response = file_get_contents($url);

// Verifica se houve erro na requisição
if (!$response) {
    echo json_encode(['erro' => 'Falha na consulta do CEP']);
    exit;
}

echo $response;
?>
