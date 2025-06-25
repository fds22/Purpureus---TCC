<?php
require_once '../../data/conexao.php';

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $conexao = conectarBanco();
        
        // Validação dos campos obrigatórios
        if (empty($_POST['nomeProd'])) {
            throw new Exception("O nome do produto é obrigatório");
        }
        
        if (empty($_POST['idTag'])) {
            throw new Exception("A categoria é obrigatória");
        }
        
        if (empty($_POST['idGenero'])) {
            throw new Exception("O gênero é obrigatório");
        }
        
        if (!isset($_POST['valorProd']) || $_POST['valorProd'] <= 0) {
            throw new Exception("O preço deve ser maior que zero");
        }

        // Validação da imagem
        if (!isset($_FILES['imagemProd']) || $_FILES['imagemProd']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("A imagem do produto é obrigatória");
        }

        // Verifica o tipo da imagem
        $allowedTypes = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif'];
        $fileType = $_FILES['imagemProd']['type'];
        
        if (!array_key_exists($fileType, $allowedTypes)) {
            throw new Exception("Tipo de arquivo não suportado. Use apenas JPEG, PNG ou GIF.");
        }
        
        // Verifica o tamanho da imagem (máximo 5MB)
        $maxSize = 100 * 1024 * 1024; // 5MB
        if ($_FILES['imagemProd']['size'] > $maxSize) {
            throw new Exception("O tamanho da imagem não pode exceder 100MB.");
        }
        
        // Lê o conteúdo da imagem
        $imagemProd = file_get_contents($_FILES['imagemProd']['tmp_name']);

        // Prepara os dados
        $nomeProd = trim($_POST['nomeProd']);
        $idTag = (int)$_POST['idTag'];
        $idMarca = !empty($_POST['idMarca']) ? (int)$_POST['idMarca'] : null;
        $idGenero = (int)$_POST['idGenero'];
        $descricaoProd = trim($_POST['descricaoProd']);
        $valorProd = (float)str_replace(',', '.', $_POST['valorProd']);
        $valorCusto = !empty($_POST['valorCusto']) ? (float)str_replace(',', '.', $_POST['valorCusto']) : 0;
        $quantidade = !empty($_POST['quantidade']) ? (int)$_POST['quantidade'] : 0;
        $cor = trim($_POST['cor'] ?? '');
        $material = trim($_POST['material'] ?? '');
        
        // Processa tamanhos
        $tamanhosDisponiveis = ['PP', 'P', 'M', 'G', 'GG', 'XGG'];
        $tamanhosSelecionados = [];
        
        foreach ($tamanhosDisponiveis as $tamanho) {
            if (isset($_POST[strtolower($tamanho)])) {
                $tamanhosSelecionados[] = $tamanho;
            }
        }
        
        $tamanhoDisp = !empty($tamanhosSelecionados) ? implode(',', $tamanhosSelecionados) : '';
        $peso = !empty($_POST['peso']) ? trim($_POST['peso']) : '';

        // Prepara e executa a query (agora incluindo a imagem)
        $sql = "INSERT INTO produto (
            nomeProd, idTag, idMarca, idGenero, descricaoProd, 
            valorProd, valorCusto, quantidade, cor, material, 
            tamanhoDisp, peso, imagemProd
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conexao->prepare($sql);
        
        if (!$stmt) {
            throw new Exception("Erro ao preparar a query: " . $conexao->error);
        }
        
        // Note o 'b' no final para o parâmetro BLOB
        $null = null;
        $stmt->bind_param(
            'siiisddissssb',
            $nomeProd, $idTag, $idMarca, $idGenero, $descricaoProd,
            $valorProd, $valorCusto, $quantidade, $cor, $material,
            $tamanhoDisp, $peso, $null
        );

        $imagemNull = null; // uma variável para passar null no bind_param
        
        // Associa o parâmetro BLOB
        $stmt->send_long_data(12, $imagemProd);
        
        if ($stmt->execute()) {
            $idProduto = $conexao->insert_id;
            header('Location: cadastroProduto.php?status=success&id=' . $idProduto);
            exit();
        } else {
            throw new Exception("Erro ao cadastrar produto: " . $stmt->error);
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        header('Location: cadastroProduto.php?status=error&message=' . urlencode($e->getMessage()));
        exit();
    } finally {
        if (isset($conexao)) {
            $conexao->close();
        }
    }
} else {
    header('Location: cadastroProduto.php');
    exit();
}