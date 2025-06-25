<?php
require_once '../data/conexao.php';

function getProdutos($conexao, $pagina = 1, $itensPorPagina = 16) {
    $offset = ($pagina - 1) * $itensPorPagina;
    
    // Query para os produtos da página atual
    $sql = "SELECT 
                p.*, 
                t.tag AS tag_nome,
                m.marca AS marca_nome,
                g.genero AS genero_nome
            FROM produto p
            LEFT JOIN tag t ON p.idTag = t.idTag
            LEFT JOIN marca m ON p.idMarca = m.idMarca
            LEFT JOIN genero g ON p.idGenero = g.idGenero
            ORDER BY p.nomeProd
            LIMIT ?, ?";
    
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ii", $offset, $itensPorPagina);
    $stmt->execute();
    $result = $stmt->get_result();
    $produtosPagina = $result->fetch_all(MYSQLI_ASSOC);
    
    // Query para contar o total de produtos
    $sqlCount = "SELECT COUNT(*) as total FROM produto";
    $resultCount = $conexao->query($sqlCount);
    $totalProdutos = $resultCount->fetch_assoc()['total'];
    $totalPaginas = ceil($totalProdutos / $itensPorPagina);
    
    return [
        'produtos' => $produtosPagina,
        'totalPaginas' => $totalPaginas,
        'paginaAtual' => $pagina,
        'totalProdutos' => $totalProdutos
    ];
}
?>