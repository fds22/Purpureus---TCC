<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Púrpura - Cadastro</title>
    <link rel="stylesheet" href="cadastro.css">
    <link rel="shortcut icon" href="../html/css/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configura o toggle para a primeira senha
            const togglePassword1 = document.querySelector('.toggle-password-1');
            const passwordInput1 = document.querySelector('input[name="senha"]');
            
            togglePassword1.addEventListener('click', function() {
                const type = passwordInput1.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput1.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });

            // Configura o toggle para a segunda senha
            const togglePassword2 = document.querySelector('.toggle-password-2');
            const passwordInput2 = document.querySelector('input[name="confirmar_senha"]');
            
            togglePassword2.addEventListener('click', function() {
                const type = passwordInput2.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput2.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="image-container">
            <div class="overlay"></div>
        </div>
        
        <div class="register-container">
            <div class="brand">
                <a href="index.html">
                    <h1>PÚRPURA</h1>
                    <p class="tagline">Brilhe em Púrpura</p>
                </a>
            </div>

            <h2 class="form-title">Criar Conta</h2>
        
            <form class="register-form" action="processacadastro.php" method="POST">
                
                <div class="name-fields">
                    <div class="input-group half">
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <input type="text" name="nome" placeholder="Nome" required>
                    </div>
                    
                    <div class="input-group half">
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <input type="text" name="sobrenome" placeholder="Sobrenome" required>
                    </div>
                </div>
                
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input type="email" name="email" placeholder="E-mail" required>
                </div>
                
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input type="password" name = "senha" placeholder="Digite sua Senha" required>
                    <div class="toggle-password toggle-password-1">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input type="password" name = "confirmar_senha" placeholder="Digite sua Senha Novamente" required>
                    <div class="toggle-password toggle-password-2">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>

                <?php if(isset($_SESSION['cadastro_erro'])): ?>
                    <div class="message error"><?php echo $_SESSION['cadastro_erro']; unset($_SESSION['cadastro_erro']); ?></div>
                <?php endif; ?>
        
                <?php if(isset($_SESSION['cadastro_sucesso'])): ?>
                    <div class="message success"><?php echo $_SESSION['cadastro_sucesso']; unset($_SESSION['cadastro_sucesso']); ?></div>
                <?php endif; ?>

                <div class="form-options">
                    <div class="terms">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">Eu concordo com os <a href="#" class="terms-link">Termos e Condições</a> e <a href="#" class="terms-link">Política de Privacidade</a></label>
                    </div>
                </div>
                
                <button type="submit" class="btn-register">Cadastrar</button>
            </form>
            
            <div class="social-register">
                <p>Ou cadastre-se com</p>
                <div class="social-buttons">
                    <a href="#" class="social-btn facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-btn google">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="social-btn apple">
                        <i class="fab fa-apple"></i>
                    </a>
                </div>
            </div>
            
            <div class="login-link">
                <p>Já tem uma conta? <a href="../login/login.php">Fazer Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>