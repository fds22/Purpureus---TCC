<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Púrpura - Login Administrador</title>
    <link rel="stylesheet" href="loginAdm.css">
    <link rel="shortcut icon" href="../html/css/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="../../html/css/img/logo.png" type="image/x-icon">
    <script>
        setTimeout(function() {
            const errorElement = document.getElementById('erro');
            if (errorElement) {
                errorElement.style.display = 'none';
            }
        }, 3000);

        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('.toggle-password');
            const passwordInput = document.querySelector('input[name="senha"]');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.querySelector('i').classList.toggle('fa-eye');
                    this.querySelector('i').classList.toggle('fa-eye-slash');
                });
            }
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="brand">
                <a href="../../html/index.php">
                    <h1>PÚRPURA</h1>
                    <p class="tagline">Painel Administrativo</p>
                </a>
            </div>

            <div class="admin-badge">
                <i class="fas fa-shield-alt"></i>
                <span>Acesso Restrito</span>
            </div>

            <h2 class="form-title">Login Administrador</h2>
            
            <form class="login-form" action="processaloginAdm.php" method="POST">
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <input type="email" placeholder="E-mail do Administrador" name="email" required autocomplete="username">
                </div>
                
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input type="password" placeholder="Senha" name="senha" required autocomplete="current-password">
                    <div class="toggle-password">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>

                <?php
                    session_start();
                    if (isset($_SESSION['erro_login_admin'])) {
                        echo '<div class="error" id="erro">'.$_SESSION['erro_login_admin'].'</div>';
                        unset($_SESSION['erro_login_admin']);
                    } else {
                        echo '<div class="error" id="erro" style="display: none;"></div>';
                    }
                ?>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    Acessar Painel
                </button>
            </form>
            
            <div class="back-to-site">
                <a href="../../html/index.php">
                    <i class="fas fa-arrow-left"></i>
                    Voltar ao site
                </a>
            </div>
        </div>
        
        <div class="image-container">
            <div class="overlay"></div>
            <div class="admin-pattern">
                <div class="pattern-grid">
                    <div class="pattern-dot"></div>
                    <div class="pattern-dot"></div>
                    <div class="pattern-dot"></div>
                    <div class="pattern-dot"></div>
                    <div class="pattern-dot"></div>
                    <div class="pattern-dot"></div>
                    <div class="pattern-dot"></div>
                    <div class="pattern-dot"></div>
                    <div class="pattern-dot"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>