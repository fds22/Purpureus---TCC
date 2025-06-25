<?php
session_start();
require_once 'produto_controller.php';
require_once '../data/conexao.php';

$conexao = conectarBanco();

// Configuração da paginação
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$dadosProdutos = getProdutos($conexao, $paginaAtual);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Púrpura - Loja de Roupas</title>
    <link rel="stylesheet" href="../html/css/style.css">
    <link rel="stylesheet" href="css/produtos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="../html/css/img/logo.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="produto.js"></script>
</head>
<body>
    <header>
        <div class="logo-container">
            <h1><a href="../html/index.php">PÚRPURA</a></h1>
            <p class="tagline">Brilhe em Púrpura</p>
        </div>
        <nav>
            <ul class="menu">
                <li><a href="../html/index.php">Início</a></li>
                <li><a href="../feminina_controller/femenina.html">Mulher</a></li>
                <li><a href="../homem_controller/homem.html">Homem</a></li>
                <li><a href="../acessorios_controller/acessorio.html">Acessórios</a></li>
                <li><a href="../produtos_controller/produtos.php" class="active">Produtos</a></li>
                <li><a href="../html/sobre.html">Sobre</a></li>
            </ul>
        </nav>
        <div class="icons">
            <a href="produtos.html" class="icon"><i class="fas fa-search"></i></a>
            <a href="../conta_controller/conta.php" class="icon"><i class="fas fa-user"></i></a>
            <a href="favoritos.html" class="icon"><i class="fas fa-heart"></i></a>
            <a href="carrinho.html" class="icon cart-icon"><i class="fas fa-shopping-bag"></i><span class="cart-count">0</span></a>
        </div>
    </header>

    <section class="produtos-banner">
        <div class="banner-content">
            <h1>Nossos Produtos</h1>
            <p>Explore nossa coleção exclusiva</p>
        </div>
    </section>

    <section class="produtos-container" id="produtos-container">
        <div class="filtro-busca">
            <div class="search-bar">
                <input type="text" placeholder="Buscar produtos...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>
            
            <div class="filtros">
                <h3>Filtrar por categoria</h3>
                <div class="filtro-opcoes">
                    <label class="filtro-item">
                        <input type="checkbox" name="categoria" value="camisas">
                        <span class="filtro-nome">Camisas</span>
                        <span class="filtro-count">(24)</span>
                    </label>
                    <label class="filtro-item">
                        <input type="checkbox" name="categoria" value="calcas">
                        <span class="filtro-nome">Calças</span>
                        <span class="filtro-count">(18)</span>
                    </label>
                    <label class="filtro-item">
                        <input type="checkbox" name="categoria" value="tenis">
                        <span class="filtro-nome">Tênis</span>
                        <span class="filtro-count">(12)</span>
                    </label>
                </div>
                
                <h3>Filtrar por preço</h3>
                <div class="filtro-preco">
                    <input type="range" min="0" max="500" value="500" class="preco-slider" id="preco-max">
                    <div class="preco-range">
                        <span>R$ 0</span>
                        <span id="preco-valor">R$ 500</span>
                    </div>
                </div>
                
                <h3>Ordenar por</h3>
                <select class="ordenar-select">
                    <option value="relevancia">Relevância</option>
                    <option value="menor-preco">Menor preço</option>
                    <option value="maior-preco">Maior preço</option>
                    <option value="novidades">Novidades</option>
                </select>

                <button class="btn-primary filtrar-btn">Aplicar Filtros</button>
            </div>
        </div>

        <div class="produtos-resultados">
            <div class="resultados-header">
                <p>Exibindo <span id="produtos-exibindo">0</span> de <span id="total-produtos">0</span> produtos</p>
                <div class="view-options">
                    <button class="view-btn active"><i class="fas fa-th"></i></button>
                    <button class="view-btn"><i class="fas fa-list"></i></button>
                </div>
            </div>
            
            <div class="produtos-grid" id="produtos-grid">
                <?php foreach ($dadosProdutos['produtos'] as $produto): ?>
                    <div class="product-card">

                        <div class="product-image">
                            <?php if (!empty($produto['imagemProd'])): ?>
                                <img src="data:image/jpeg;base64,<?= base64_encode($produto['imagemProd']) ?>" alt="<?= htmlspecialchars($produto['nomeProd']) ?>">
                            <?php else: ?>
                                <img src="/api/placeholder/300/400" alt="<?= htmlspecialchars($produto['nomeProd']) ?>">
                            <?php endif; ?>

                            <div class="product-overlay">
                                <a href="#" class="overlay-icon"><i class="fas fa-heart"></i></a>
                                <a href="#" class="overlay-icon"><i class="fas fa-shopping-cart"></i></a>
                                <a href="detalhes.php?id=<?= $produto['idProduto'] ?>" class="overlay-icon"><i class="fas fa-search"></i></a>
                            </div>

                            <?php 
                                $randomTag = rand(1, 3);
                                if ($randomTag == 1) {
                                    echo '<span class="tag new">NOVO</span>';
                                } elseif ($randomTag == 2) {
                                    echo '<span class="tag sale">-'.rand(5, 30).'%</span>';
                                }
                            ?>

                        </div>
                        <div class="product-info">
                            <h3><?= htmlspecialchars($produto['nomeProd']) ?></h3>
                            <p class="product-category"><?= htmlspecialchars($produto['tag_nome']) ?></p>
                            <p class="product-price"><?php 
                                if (isset($randomTag) && $randomTag == 2) {
                                    $desconto = rand(5, 30) / 100;
                                    $precoOriginal = $produto['valorProd'];
                                    $precoComDesconto = $precoOriginal * (1 - $desconto);
                                    echo '<span class="old-price">R$ '.number_format($precoOriginal, 2, ',', '.').'</span> R$ '.number_format($precoComDesconto, 2, ',', '.');
                                } else {
                                    echo 'R$ '.number_format($produto['valorProd'], 2, ',', '.');
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="paginacao"id="paginacao">
                
            </div>
        </div>
    </section>

    <section class="newsletter">
        <div class="newsletter-content">
            <h2>Inscreva-se na nossa newsletter</h2>
            <p>Receba as novidades, promoções exclusivas e dicas de moda em primeira mão</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Seu e-mail" required>
                <button type="submit" class="btn-primary">Inscrever-se</button>
            </form>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>Púrpura</h3>
                <p>Sua essência em cores, moda que reflete sua personalidade.</p>
                <div class="social-media">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-pinterest"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Links Rápidos</h3>
                <ul class="footer-links">
                    <li><a href="#">Início</a></li>
                    <li><a href="#">Produtos</a></li>
                    <li><a href="#">Sobre nós</a></li>
                    <li><a href="#">Contato</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Ajuda</h3>
                <ul class="footer-links">
                    <li><a href="#">Dúvidas Frequentes</a></li>
                    <li><a href="#">Envios e Entregas</a></li>
                    <li><a href="#">Política de Devoluções</a></li>
                    <li><a href="#">Termos e Condições</a></li>
                    <li><a href="#">Política de Privacidade</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Contato</h3>
                <ul class="contact-info">
                    <li><i class="fas fa-map-marker-alt"></i> Av. Principal, 1000</li>
                    <li><i class="fas fa-phone"></i> (11) 99999-9999</li>
                    <li><i class="fas fa-envelope"></i> contato@purpura.com.br</li>
                </ul>
                <div class="payment-methods">
                    <i class="fab fa-cc-visa"></i>
                    <i class="fab fa-cc-mastercard"></i>
                    <i class="fab fa-cc-amex"></i>
                    <i class="fab fa-cc-apple-pay"></i>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2025 Púrpura - Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>