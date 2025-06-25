<?php
session_start();
// Verifica se o usuário está logado
if(!isset($_SESSION['usuario_id'])) {
    header("Location: ../login/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Púrpura - Loja de Roupas</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="css/img/logo.png" type="image/x-icon">
</head>
<body>
    <header>
        <div class="logo-container">
            <h1><a href="index.php">PÚRPURA</a></h1>
            <p class="tagline">Brilhe em Púrpura</p>
        </div>
        <nav>
            <ul class="menu">
                <li><a href="index.php" class="active">Início</a></li>
                <li><a href="../feminina_controller/femenina.html">Mulher</a></li>
                <li><a href="../homem_controller/homem.html">Homem</a></li>
                <li><a href="../acessorios_controller/acessorio.html">Acessórios</a></li>
                <li><a href="../produtos_controller/produtos.php">Produtos</a></li>
                <li><a href="sobre.html">Sobre</a></li>
            </ul>
        </nav>
        
        <div class="icons">
            <a href="../produtos_controller/produtos.php" class="icon"><i class="fas fa-search"></i></a>
            <a href="../conta_controller/conta.php" class="icon"><i class="fas fa-user"></i></a>
            <a href="../favoritos_controller/favoritos.html" class="icon"><i class="fas fa-heart"></i></a>
            <a href="../carrinho_controller/carrinho.html" class="icon cart-icon"><i class="fas fa-shopping-bag"></i><span class="cart-count">0</span></a>
        </div>

        <div class="user-info">
            <span>Olá, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></span>
            <form action="../login/login.php" method="post">
                <a href="../logout/logout.php" class="logout-btn">Sair</a>
            </form>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h2>Nova Coleção</h2>
            <h3>OUTONO/INVERNO</h3>
            <p>Descubra o poder do roxo na sua vida</p>
            <a href="#" class="btn-primary">Comprar Agora</a>
        </div>
    </section>

    <section class="categories">
        <h2 class="section-title">Categorias</h2>
        <div class="category-container">
            <div class="category">
                <img src="css/img/moda femenina.jpeg" alt="Categoria Feminina">
                <h3>Feminino</h3>
                <a href="#" class="btn-secondary">Ver Produtos</a>
            </div>
            <div class="category">
                <img src="css/img/moda-masculina.png" alt="Categoria Masculina">
                <h3>Masculino</h3>
                <a href="#" class="btn-secondary">Ver Produtos</a>
            </div>
            <div class="category">
                <img src="css/img/acessorio.png" alt="Categoria Acessórios">
                <h3>Acessórios</h3>
                <a href="#" class="btn-secondary">Ver Produtos</a>
            </div>
        </div>
    </section>

    <section class="featured-products">
        <h2 class="section-title">Produtos em Destaque</h2>
        <div class="products-grid">
            <div class="product-card">
                <div class="product-image">
                    <img src="/api/placeholder/300/400" alt="Produto 1">
                    <div class="product-overlay">
                        <a href="#" class="overlay-icon"><i class="fas fa-heart"></i></a>
                        <a href="#" class="overlay-icon"><i class="fas fa-shopping-cart"></i></a>
                        <a href="#" class="overlay-icon"><i class="fas fa-search"></i></a>
                    </div>
                    <span class="tag new">NOVO</span>
                </div>
                <div class="product-info">
                    <h3>Vestido Púrpura Elegance</h3>
                    <p class="product-category">Vestidos</p>
                    <p class="product-price">R$ 199,90</p>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <img src="/api/placeholder/300/400" alt="Produto 2">
                    <div class="product-overlay">
                        <a href="#" class="overlay-icon"><i class="fas fa-heart"></i></a>
                        <a href="#" class="overlay-icon"><i class="fas fa-shopping-cart"></i></a>
                        <a href="#" class="overlay-icon"><i class="fas fa-search"></i></a>
                    </div>
                </div>
                <div class="product-info">
                    <h3>Camiseta Black Purple</h3>
                    <p class="product-category">Camisetas</p>
                    <p class="product-price">R$ 89,90</p>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <img src="/api/placeholder/300/400" alt="Produto 3">
                    <div class="product-overlay">
                        <a href="#" class="overlay-icon"><i class="fas fa-heart"></i></a>
                        <a href="#" class="overlay-icon"><i class="fas fa-shopping-cart"></i></a>
                        <a href="#" class="overlay-icon"><i class="fas fa-search"></i></a>
                    </div>
                    <span class="tag sale">-20%</span>
                </div>
                <div class="product-info">
                    <h3>Calça Violet Comfort</h3>
                    <p class="product-category">Calças</p>
                    <p class="product-price"><span class="old-price">R$ 159,90</span> R$ 127,92</p>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <img src="/api/placeholder/300/400" alt="Produto 4">
                    <div class="product-overlay">
                        <a href="#" class="overlay-icon"><i class="fas fa-heart"></i></a>
                        <a href="#" class="overlay-icon"><i class="fas fa-shopping-cart"></i></a>
                        <a href="#" class="overlay-icon"><i class="fas fa-search"></i></a>
                    </div>
                </div>
                <div class="product-info">
                    <h3>Jaqueta Modern Purple</h3>
                    <p class="product-category">Jaquetas</p>
                    <p class="product-price">R$ 249,90</p>
                </div>
            </div>
        </div>
        <div class="view-more">
            <a href="#" class="btn-primary">Ver mais produtos</a>
        </div>
    </section>

    <section class="promotion-banner">
        <div class="promotion-content">
            <h2>Desconto Especial</h2>
            <p>20% OFF em toda a nova coleção</p>
            <p class="promo-code">Use o código: <span>PURPURA20</span></p>
            <a href="#" class="btn-primary">Comprar Agora</a>
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