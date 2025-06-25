<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Púrpura - Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="shortcut icon" href="../html/css/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        setTimeout(function() {
            document.getElementById('erro').style.display = 'none';
        }, 1000);

        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('.toggle-password');
            const passwordInput = document.querySelector('input[name="senha"]');

            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="brand">
                <a href="index.html">
                    <h1>PÚRPURA</h1>
                    <p class="tagline">Brilhe em Púrpura</p>
                </a>
            </div>

            <h2 class="form-title">Login</h2>
            
            <form class="login-form" action="processalogin.php" method="POST">
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input placeholder="E-mail" name="email" required>
                </div>
                
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input type="password" placeholder="Senha" name="senha" required>
                    <div class="toggle-password">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>
                
                <div class="form-options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember">
                        <label for="remember">Lembrar-me</label>
                    </div>
                    <a href="#" class="forgot-password">Esqueceu a senha?</a>
                </div>
                
                <?php
                    session_start();
                    if (isset($_SESSION['erro_login'])) {
                        echo '<div class="error" id="erro">'.$_SESSION['erro_login'].'</div>';
                    } else {
                        echo '<div class="error" id="erro" style="display: none;"></div>';
                    }
                ?>

                <button type="submit" class="btn-login">Entrar</button>
            </form>
            
            <div class="social-login">
                <p>Ou entre com</p>
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
            <div class="register-link">
                <p>Não tem uma conta? <a href="../cadastro/cadastro.php">Cadastre-se</a></p>
            </div>
        </div>
        
        <div class="image-container">
            <div class="overlay"></div>
        </div>
    </div>
</body>
</html>