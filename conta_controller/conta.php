<?php
session_start();
require_once '../data/conexao.php';

// Verifica se o usuário está logado
if(!isset($_SESSION['usuario_id'])) {
    header("Location: ../login/login.php");
    exit();
}

// Conexão com o banco de dados
$conexao = conectarBanco();

// Busca os dados atuais do usuário
$sql = "SELECT * FROM usuario WHERE idUsuario = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $_SESSION['usuario_id']);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta - Púrpura</title>
    <link rel="stylesheet" href="../html/css/style.css">
    <link rel="stylesheet" href="conta.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="css/img/logo.png" type="image/x-icon">
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
                <li><a href="../produtos_controller/produtos.php">Produtos</a></li>
                <li><a href="../html/sobre.html">Sobre</a></li>



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
        </div>
    </header>
                                <!-- DADOS PESSOAS-->      
    <div class="account-container">
        <div class="sidebar">
            <div class="user-info">
                <div class="user-avatar">
                    <img src="/api/placeholder/100/100" alt="Foto do Usuário">
                    <div class="edit-avatar">
                        <i class="fas fa-camera"></i>
                    </div>
                </div>
                <h3>Olá, <?php echo htmlspecialchars($usuario['nome'] . ' ' . $usuario['sobrenome']); ?></h3>
            </div>
            <ul class="account-menu">
                <li class="active"><a href="#"><i class="fas fa-user-circle"></i> Dados Pessoais</a></li>
                <li><a href="#"><i class="fas fa-map-marker-alt"></i> Endereços</a></li>
                <li><a href="#"><i class="fas fa-shopping-bag"></i> Meus Pedidos</a></li>
                <li><a href="#"><i class="fas fa-heart"></i> Lista de Desejos</a></li>
                <li><a href="#"><i class="fas fa-bell"></i> Notificações</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Preferências</a></li>
                <li class="logout"><a href="../login/login.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
            </ul>
        </div>

        <div class="account-content">
            <div class="content-section active" id="personal-data">
                <h2 class="section-title">Dados Pessoais</h2>
                
                <?php if(isset($_SESSION['mensagem_sucesso'])): ?>
                    <div class="alert alert-success">
                        <?php echo $_SESSION['mensagem_sucesso']; unset($_SESSION['mensagem_sucesso']); ?>
                    </div>
                <?php endif; ?>
                
                <?php if(isset($_SESSION['mensagem_erro'])): ?>
                    <div class="alert alert-error">
                        <?php echo $_SESSION['mensagem_erro']; unset($_SESSION['mensagem_erro']); ?>
                    </div>
                <?php endif; ?>
                
                <div class="account-card">
                    <form class="account-form" method="POST" action="processaDadosPessoais.php">
                        <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['usuario_id']; ?>">
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" id="nome" name="nome" class="purple-input" required>
                            </div>
                            <div class="form-group">
                                <label for="sobrenome">Sobrenome</label>
                                <input type="text" id="sobrenome" name="sobrenome" class="purple-input" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" id="email" name="email" class="purple-input" required>
                            </div>
                        </div>
                        
                        <div class="form-group password-group">
                            <label for="senha">Alterar Senha</label>
                            <input type="password" id="senha" name="senha" class="purple-input" placeholder="Deixe em branco para manter a senha atual">
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn-primary">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="content-section" id="addresses">
                <h2 class="section-title">Meus Endereços</h2>
                <div class="account-card">
                    <div class="addresses-container">
                        <div class="add-address">
                            <button id="add-address-btn" class="btn-secondary">
                                <i class="fas fa-plus"></i> Adicionar Novo Endereço
                            </button>
                        </div>
                    </div>
                
                    <div class="address-form-container" id="address-form" style="display: none;">
                        <h3>Novo Endereço</h3>
                        <form id="address-form" class="address-form" method="POST" action="endereco.php" multipart="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="address-name">Nome do Endereço</label>
                                    <input type="text" id="address-name" name="nome_endereco" placeholder="Ex: Casa, Trabalho" class="purple-input" required>
                                </div>
                                <div class="form-group">
                                    <label for="cep">CEP</label>
                                    <div class="cep-input-group">
                                        <input type="text" id="cep" name="cep" placeholder="00000-000" class="purple-input" required>
                                        <button type="button" id="search-cep" class="btn-cep">Buscar</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="street">Rua</label>
                                    <input type="text" id="street" name="rua" class="purple-input" required>
                                </div>
                                <div class="form-group">
                                    <label for="number">Número</label>
                                    <input type="text" id="number" name="numero" class="purple-input" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="complement">Complemento</label>
                                    <input type="text" id="complement" name="complemento" placeholder="Opcional" class="purple-input">
                                </div>
                                <div class="form-group">
                                    <label for="neighborhood">Bairro</label>
                                    <input type="text" id="neighborhood" name="bairro" class="purple-input" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="city">Cidade</label>
                                    <input type="text" id="city" name="cidade" class="purple-input" required>
                                </div>
                                <div class="form-group">
                                    <label for="state">Estado</label>
                                    <select id="state" name="estado" class="purple-input" required>
                                        <option value="">Selecione</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="MG">Minas Gerais</option>
                                        <!-- Adicione os demais estados -->
                                    </select>
                                </div>
                            </div>

                            <div class="form-group checkbox-group">
                                <input type="checkbox" id="default-address" name="principal">
                                <label for="default-address">Definir como endereço principal</label>
                            </div>

                            <div class="form-actions">
                                <button type="button" id="cancel-address" class="btn-secondary">Cancelar</button>
                                <button type="submit" class="btn-primary">Salvar Endereço</button>
                            </div>
                        </form>

                        <div id="mensagem"></div>


                    </div>
                </div>
            </div>
        </div>
    </div>
                <!-- FIM DADOS PESSOAIS -->
            
        </div>
    </div>

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

    <script>
    // Toggle entre seções da conta
    document.querySelectorAll('.account-menu li').forEach(item => {
        item.addEventListener('click', function() {
            // Remove a classe active de todos os itens do menu
            document.querySelectorAll('.account-menu li').forEach(menuItem => {
                menuItem.classList.remove('active');
            });
            
            // Adiciona a classe active ao item clicado
            this.classList.add('active');
            
            // Esconde todas as seções de conteúdo
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Identifica qual seção mostrar baseado no texto do link
            const linkText = this.querySelector('a').textContent.trim();
            
            if (linkText.includes('Dados Pessoais')) {
                document.getElementById('personal-data').classList.add('active');
            } else if (linkText.includes('Endereços')) {
                document.getElementById('addresses').classList.add('active');
            }
        });
    });
    
    // Mostrar/ocultar formulário de novo endereço
    document.getElementById('add-address-btn').addEventListener('click', function() {
        document.getElementById('address-form').style.display = 'block';
        this.parentElement.style.display = 'none';
        // Limpar campos quando abrir o formulário
        clearAddressForm();
    });
    
    document.getElementById('cancel-address').addEventListener('click', function() {
        document.getElementById('address-form').style.display = 'none';
        document.querySelector('.add-address').style.display = 'block';
        clearAddressForm();
    });
    
    // Limpar formulário de endereço
    function clearAddressForm() {
        document.getElementById('address-name').value = '';
        document.getElementById('cep').value = ''
        document.getElementById('street').value = '';
        document.getElementById('number').value = '';
        document.getElementById('complement').value = '';
        document.getElementById('neighborhood').value = '';
        document.getElementById('city').value = '';
        document.getElementById('state').value = '';
        document.getElementById('default-address').checked = false;
    }
    
    // Busca de CEP real usando API
    document.getElementById('search-cep').addEventListener('click', searchCep);
    document.getElementById('cep').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            searchCep();
            e.preventDefault();
        }
    });
    
    // Função searchCep corrigida
function searchCep() {
    const cepInput = document.getElementById('cep');
    let cep = cepInput.value.replace(/\D/g, '');
    
    if (!/^\d{8}$/.test(cep)) {
        showAddressError('CEP inválido. Digite 8 números.');
        return;
    }
    
    // Mostrar loading
    const searchBtn = document.getElementById('search-cep');
    const originalBtnText = searchBtn.innerHTML;
    searchBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Buscando...';
    searchBtn.disabled = true;
    
    
    fetch("https://viacep.com.br/ws/$cep/json/".replace('$cep', cep))
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(data => {
            if (data.erro) {
                throw new Error('CEP não encontrado');
            }
            
            // Preencher os campos com os dados retornados
            document.getElementById('street').value = data.logradouro || '';
            document.getElementById('neighborhood').value = data.bairro || '';
            document.getElementById('city').value = data.localidade || '';
            document.getElementById('state').value = data.uf || '';
            
            // Focar no campo número
            document.getElementById('number').focus();
            
            // Esconder mensagens de erro
            hideAddressError();
        })
        .catch(error => {
            showAddressError('CEP não encontrado. Verifique o número digitado.');
            console.error('Erro ao buscar CEP:', error);
        })
        .finally(() => {
            // Restaurar o botão
            searchBtn.innerHTML = originalBtnText;
            searchBtn.disabled = false;
        });
}
    
    function showAddressError(message) {
        hideAddressError();
        
        const errorElement = document.createElement('div');
        errorElement.className = 'cep-error';
        errorElement.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
        
        const cepGroup = document.querySelector('.cep-input-group');
        cepGroup.parentNode.insertBefore(errorElement, cepGroup.nextSibling);
        
        // Destacar campo inválido
        document.getElementById('cep').classList.add('input-error');
    }
    
    function hideAddressError() {
        const existingError = document.querySelector('.cep-error');
        if (existingError) {
            existingError.remove();
        }
        document.getElementById('cep').classList.remove('input-error');
    }
    
    // Formatar CEP automaticamente
    document.getElementById('cep').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        
        if (value.length > 5) {
            value = value.replace(/^(\d{5})(\d)/, '$1-$2');
        }
        
        e.target.value = value.substring(0, 9);
    });
    
    // Salvar endereço (simulação)
    document.querySelector('.address-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const addressName = document.getElementById('address-name').value;
        const cep = document.getElementById('cep').value;
        const street = document.getElementById('street').value;
        const number = document.getElementById('number').value;
        
        if (!addressName || !cep || !street || !number) {
            showAddressError('Por favor, preencha todos os campos obrigatórios.');
            return;
        }
        
        // Simulação: Adicionar novo endereço à lista
        const newAddress = {
            name: addressName,
            street: street,
            number: number,
            complement: document.getElementById('complement').value,
            neighborhood: document.getElementById('neighborhood').value,
            city: document.getElementById('city').value,
            state: document.getElementById('state').value,
            cep: cep,
            isDefault: document.getElementById('default-address').checked
        };

        
        addAddressToUI(newAddress);
        
        // Fechar formulário
        document.getElementById('address-form').style.display = 'none';
        document.querySelector('.add-address').style.display = 'block';
        clearAddressForm();
        
        // Mostrar mensagem de sucesso
        showAddressSuccess('Endereço adicionado com sucesso!');
    });
    
    function addAddressToUI(address) {
        const addressCard = document.createElement('div');
        addressCard.className = 'address-card';
        addressCard.innerHTML = `
            <div class="address-header">
                <h3>${address.name}</h3>
                ${address.isDefault ? '<span class="address-badge default">Principal</span>' : ''}
            </div>
            <div class="address-body">
                <p>${address.street}, ${address.number}${address.complement ? ', ' + address.complement : ''}</p>
                <p>${address.neighborhood}</p>
                <p>${address.city} - ${address.state}</p>
                <p>CEP: ${address.cep}</p>
            </div>
            <div class="address-actions">
                <button class="address-btn edit-btn"><i class="fas fa-edit"></i> Editar</button>
                <button class="address-btn delete-btn"><i class="fas fa-trash"></i> Excluir</button>
            </div>
        `;
        
        document.querySelector('.addresses-container').insertBefore(addressCard, document.querySelector('.add-address'));
    }
    
    function showAddressSuccess(message) {
        const successElement = document.createElement('div');
        successElement.className = 'cep-success';
        successElement.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
        
        const sectionTitle = document.querySelector('#addresses .section-title');
        sectionTitle.parentNode.insertBefore(successElement, sectionTitle.nextSibling);
        
        setTimeout(() => {
            successElement.remove();
        }, 3000);
    }
    
    // Preencher formulário de dados pessoais com informações do usuário
    window.addEventListener('DOMContentLoaded', () => {
        const nomeInput = document.getElementById('nome');
        const sobrenomeInput = document.getElementById('sobrenome');
        const emailInput = document.getElementById('email');
        
        <?php if(isset($usuario)): ?>
            nomeInput.value = "<?php echo htmlspecialchars($usuario['nome'] ?? ''); ?>";
            sobrenomeInput.value = "<?php echo htmlspecialchars($usuario['sobrenome'] ?? ''); ?>";
            emailInput.value = "<?php echo htmlspecialchars($usuario['email'] ?? ''); ?>";
        <?php endif; ?>
    });

    document.getElementById('address-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const dados = {
        nome_endereco: document.getElementById('address-name').value,
        cep: document.getElementById('cep').value,
        rua: document.getElementById('street').value,
        numero: document.getElementById('number').value,
        complemento: document.getElementById('complement').value,
        bairro: document.getElementById('neighborhood').value,
        cidade: document.getElementById('city').value,
        estado: document.getElementById('state').value,
        principal: document.getElementById('default-address').checked
    };


    fetch('endereco.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(dados)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Dados:', dados);
        const mensagem = document.getElementById('mensagem');
        if (data.sucesso) {
            mensagem.innerHTML = `<p style="color: green;">${data.mensagem}</p>`;
            document.getElementById('address-form').reset();
        } else {
            mensagem.innerHTML = `<p style="color: red;">Erro: ${data.mensagem}</p>`;
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        document.getElementById('mensagem').innerHTML = `<p style="color: red;">Erro na requisição.</p>`;
    });
});

</script>
</body>
</html>