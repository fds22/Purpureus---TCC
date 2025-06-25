<?php
session_start();
// Verifica se o usuário está logado
if(!isset($_SESSION['adm_id'])) {
    header("Location: ../login/loginAdm.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Púrpura Admin - Painel de Controle</title>
    <link rel="stylesheet" href="dashbord.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="../../html/css/img/logo.png" type="image/x-icon">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar de navegação -->
        <nav class="sidebar">
            <div class="logo-container">
                <h1>PÚRPURA</h1>
                <p class="tagline">Área Administrativa</p>
            </div>
            <ul class="admin-menu">
                <li>
                    <a href="dashbord.php" class="menu-item active" data-page="dashboard">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="../produtos/cadastroProduto.php" class="menu-item" data-page="produtos">
                        <i class="fas fa-tshirt"></i>
                        <span>Produtos</span>
                    </a>
                </li>
                <li>
                    <a href="#pedidos" class="menu-item" data-page="pedidos">
                        <i class="fas fa-shopping-bag"></i>
                        <span>Pedidos</span>
                    </a>
                </li>
                <li>
                    <a href="#clientes" class="menu-item" data-page="clientes">
                        <i class="fas fa-users"></i>
                        <span>Clientes</span>
                    </a>
                </li>
                <li>
                    <a href="#categorias" class="menu-item" data-page="categorias">
                        <i class="fas fa-tags"></i>
                        <span>Categorias</span>
                    </a>
                </li>
                <li>
                    <a href="#relatorios" class="menu-item" data-page="relatorios">
                        <i class="fas fa-chart-bar"></i>
                        <span>Relatórios</span>
                    </a>
                </li>
                <li>
                    <a href="#configuracoes" class="menu-item" data-page="configuracoes">
                        <i class="fas fa-cog"></i>
                        <span>Configurações</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="../logout/logoutAdm.php" class="logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Sair</span>
                </a>
            </div>
        </nav>

        <!-- Conteúdo principal -->
        <main class="main-content">
            <!-- Cabeçalho -->
            <header class="admin-header">
                <div class="toggle-sidebar">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="admin-search">
                    <input type="text" placeholder="Pesquisar...">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>
                <div class="admin-profile">
                    <div class="notifications">
                        <i class="fas fa-bell"></i>
                        <span class="badge">3</span>
                    </div>
                    <div class="admin-info">
                        <span>Seja Bem Vindo, <?php echo htmlspecialchars($_SESSION['adm_nome']); ?></span>
                        <img src="../img/adm.jpeg" alt="" class="admin-avatar">
                    </div>
                </div>
            </header>

            <!-- Páginas de conteúdo -->
            <div class="content-pages">
                <!-- Dashboard -->
                <div class="page active" id="dashboard">
                    <h2 class="page-title">Dashboard</h2>
                    <div class="cards-container">
                        <div class="card">
                            <div class="card-content">
                                <h3>Vendas Hoje</h3>
                                <p class="card-value">R$ 3.590,00</p>
                                <p class="card-change positive">+15.3% <span>desde ontem</span></p>
                            </div>
                            <div class="card-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-content">
                                <h3>Novos Pedidos</h3>
                                <p class="card-value">12</p>
                                <p class="card-change positive">+5 <span>desde ontem</span></p>
                            </div>
                            <div class="card-icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-content">
                                <h3>Novos Clientes</h3>
                                <p class="card-value">23</p>
                                <p class="card-change positive">+8 <span>desde ontem</span></p>
                            </div>
                            <div class="card-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-content">
                                <h3>Total de Produtos</h3>
                                <p class="card-value">548</p>
                                <p class="card-change neutral">+0 <span>desde ontem</span></p>
                            </div>
                            <div class="card-icon">
                                <i class="fas fa-box"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="charts-container">
                        <div class="chart-card">
                            <h3>Vendas Semanais</h3>
                            <div class="chart-placeholder">
                                <!-- Gráfico de vendas semanais -->
                                <div class="placeholder-chart"></div>
                            </div>
                        </div>
                        <div class="chart-card">
                            <h3>Produtos Mais Vendidos</h3>
                            <div class="chart-placeholder">
                                <!-- Gráfico de produtos mais vendidos -->
                                <div class="placeholder-chart"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="recent-activity">
                        <h3>Atividades Recentes</h3>
                        <ul class="activity-list">
                            <li>
                                <div class="activity-icon"><i class="fas fa-shopping-bag"></i></div>
                                <div class="activity-details">
                                    <p><strong>Novo pedido #1852</strong> de Maria Silva</p>
                                    <span class="time">Há 5 minutos</span>
                                </div>
                                <div class="activity-action">
                                    <a href="#" class="btn-small">Ver</a>
                                </div>
                            </li>
                            <li>
                                <div class="activity-icon"><i class="fas fa-user"></i></div>
                                <div class="activity-details">
                                    <p><strong>Novo cliente</strong> João Ferreira se registrou</p>
                                    <span class="time">Há 27 minutos</span>
                                </div>
                                <div class="activity-action">
                                    <a href="#" class="btn-small">Ver</a>
                                </div>
                            </li>
                            <li>
                                <div class="activity-icon"><i class="fas fa-box"></i></div>
                                <div class="activity-details">
                                    <p><strong>Produto atualizado:</strong> Vestido Púrpura Elegance</p>
                                    <span class="time">Há 1 hora</span>
                                </div>
                                <div class="activity-action">
                                    <a href="#" class="btn-small">Ver</a>
                                </div>
                            </li>
                            <li>
                                <div class="activity-icon"><i class="fas fa-comment"></i></div>
                                <div class="activity-details">
                                    <p><strong>Nova avaliação</strong> para Calça Violet Comfort</p>
                                    <span class="time">Há 2 horas</span>
                                </div>
                                <div class="activity-action">
                                    <a href="#" class="btn-small">Ver</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Produtos -->
                <div class="page" id="produtos">
                    <div class="page-header">
                        <h2 class="page-title">Gerenciar Produtos</h2>
                        <button class="btn-primary" id="add-product-btn"><i class="fas fa-plus"></i> Adicionar Produto</button>
                    </div>
                    
                    <!-- Formulário de Cadastro/Edição de Produto -->
                    <div class="form-container" id="product-form">
                        <h3>Cadastrar Novo Produto</h3>
                        <form>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="product-name">Nome do Produto</label>
                                    <input type="text" id="product-name" name="product-name" required>
                                </div>
                                <div class="form-group">
                                    <label for="product-category">Categoria</label>
                                    <select id="product-category" name="product-category" required>
                                        <option value="">Selecione uma categoria</option>
                                        <option value="vestidos">Vestidos</option>
                                        <option value="camisetas">Camisetas</option>
                                        <option value="calcas">Calças</option>
                                        <option value="jaquetas">Jaquetas</option>
                                        <option value="acessorios">Acessórios</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="product-price">Preço (R$)</label>
                                    <input type="number" id="product-price" name="product-price" step="0.01" required>
                                </div>
                                <div class="form-group">
                                    <label for="product-sale-price">Preço Promocional (R$)</label>
                                    <input type="number" id="product-sale-price" name="product-sale-price" step="0.01">
                                </div>
                                <div class="form-group">
                                    <label for="product-stock">Estoque</label>
                                    <input type="number" id="product-stock" name="product-stock" required>
                                </div>
                                <div class="form-group">
                                    <label for="product-gender">Gênero</label>
                                    <select id="product-gender" name="product-gender" required>
                                        <option value="">Selecione</option>
                                        <option value="feminino">Feminino</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="unisex">Unisex</option>
                                    </select>
                                </div>
                                <div class="form-group full-width">
                                    <label for="product-description">Descrição</label>
                                    <textarea id="product-description" name="product-description" rows="4" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="product-image">Imagem Principal</label>
                                    <input type="file" id="product-image" name="product-image" accept="image/*" required>
                                </div>
                                <div class="form-group">
                                    <label for="product-gallery">Galeria de Imagens</label>
                                    <input type="file" id="product-gallery" name="product-gallery" accept="image/*" multiple>
                                </div>
                                <div class="form-group">
                                    <label>Tags</label>
                                    <div class="checkbox-group">
                                        <label><input type="checkbox" name="tag-new"> Novo</label>
                                        <label><input type="checkbox" name="tag-sale"> Promoção</label>
                                        <label><input type="checkbox" name="tag-featured"> Destaque</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <div class="radio-group">
                                        <label><input type="radio" name="product-status" value="active" checked> Ativo</label>
                                        <label><input type="radio" name="product-status" value="inactive"> Inativo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn-primary">Salvar Produto</button>
                                <button type="button" class="btn-secondary" id="cancel-product">Cancelar</button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Tabela de Produtos -->
                    <div class="table-container">
                        <div class="table-filters">
                            <div class="filter-group">
                                <label for="filter-category">Categoria:</label>
                                <select id="filter-category">
                                    <option value="">Todas</option>
                                    <option value="vestidos">Vestidos</option>
                                    <option value="camisetas">Camisetas</option>
                                    <option value="calcas">Calças</option>
                                    <option value="jaquetas">Jaquetas</option>
                                    <option value="acessorios">Acessórios</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label for="filter-status">Status:</label>
                                <select id="filter-status">
                                    <option value="">Todos</option>
                                    <option value="active">Ativo</option>
                                    <option value="inactive">Inativo</option>
                                </select>
                            </div>
                            <div class="filter-search">
                                <input type="text" placeholder="Buscar produto...">
                                <button type="button"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                        
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Imagem</th>
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Preço</th>
                                    <th>Estoque</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#1001</td>
                                    <td><img src="/api/placeholder/50/50" alt="Produto" class="product-thumbnail"></td>
                                    <td>Vestido Púrpura Elegance</td>
                                    <td>Vestidos</td>
                                    <td>R$ 199,90</td>
                                    <td>25</td>
                                    <td><span class="status active">Ativo</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn edit" title="Editar"><i class="fas fa-edit"></i></button>
                                            <button class="action-btn view" title="Visualizar"><i class="fas fa-eye"></i></button>
                                            <button class="action-btn delete" title="Excluir"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1002</td>
                                    <td><img src="/api/placeholder/50/50" alt="Produto" class="product-thumbnail"></td>
                                    <td>Camiseta Black Purple</td>
                                    <td>Camisetas</td>
                                    <td>R$ 89,90</td>
                                    <td>42</td>
                                    <td><span class="status active">Ativo</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn edit" title="Editar"><i class="fas fa-edit"></i></button>
                                            <button class="action-btn view" title="Visualizar"><i class="fas fa-eye"></i></button>
                                            <button class="action-btn delete" title="Excluir"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1003</td>
                                    <td><img src="/api/placeholder/50/50" alt="Produto" class="product-thumbnail"></td>
                                    <td>Calça Violet Comfort</td>
                                    <td>Calças</td>
                                    <td>R$ 127,92</td>
                                    <td>18</td>
                                    <td><span class="status active">Ativo</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn edit" title="Editar"><i class="fas fa-edit"></i></button>
                                            <button class="action-btn view" title="Visualizar"><i class="fas fa-eye"></i></button>
                                            <button class="action-btn delete" title="Excluir"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1004</td>
                                    <td><img src="/api/placeholder/50/50" alt="Produto" class="product-thumbnail"></td>
                                    <td>Jaqueta Modern Purple</td>
                                    <td>Jaquetas</td>
                                    <td>R$ 249,90</td>
                                    <td>10</td>
                                    <td><span class="status active">Ativo</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn edit" title="Editar"><i class="fas fa-edit"></i></button>
                                            <button class="action-btn view" title="Visualizar"><i class="fas fa-eye"></i></button>
                                            <button class="action-btn delete" title="Excluir"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1005</td>
                                    <td><img src="/api/placeholder/50/50" alt="Produto" class="product-thumbnail"></td>
                                    <td>Colar Ametista Royal</td>
                                    <td>Acessórios</td>
                                    <td>R$ 89,90</td>
                                    <td>8</td>
                                    <td><span class="status inactive">Inativo</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn edit" title="Editar"><i class="fas fa-edit"></i></button>
                                            <button class="action-btn view" title="Visualizar"><i class="fas fa-eye"></i></button>
                                            <button class="action-btn delete" title="Excluir"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div class="pagination">
                            <button class="pagination-btn" disabled><i class="fas fa-angle-left"></i></button>
                            <button class="pagination-btn active">1</button>
                            <button class="pagination-btn">2</button>
                            <button class="pagination-btn">3</button>
                            <span class="pagination-ellipsis">...</span>
                            <button class="pagination-btn">10</button>
                            <button class="pagination-btn"><i class="fas fa-angle-right"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Pedidos -->
                <div class="page" id="pedidos">
                    <div class="page-header">
                        <h2 class="page-title">Gerenciar Pedidos</h2>
                    </div>
                    
                    <div class="table-container">
                        <div class="table-filters">
                            <div class="filter-group">
                                <label for="filter-order-status">Status:</label>
                                <select id="filter-order-status">
                                    <option value="">Todos</option>
                                    <option value="pending">Pendente</option>
                                    <option value="processing">Em processamento</option>
                                    <option value="shipped">Enviado</option>
                                    <option value="delivered">Entregue</option>
                                    <option value="canceled">Cancelado</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label for="filter-date">Data:</label>
                                <input type="date" id="filter-date">
                            </div>
                            <div class="filter-search">
                                <input type="text" placeholder="Buscar pedido/cliente...">
                                <button type="button"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                        
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Pedido #</th>
                                    <th>Cliente</th>
                                    <th>Data</th>
                                    <th>Total</th>
                                    <th>Forma de Pgto</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#2001</td>
                                    <td>Maria Silva</td>
                                    <td>19/05/2025</td>
                                    <td>R$ 199,90</td>
                                    <td>Cartão de crédito</td>
                                    <td><span class="status pending">Pendente</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn view" title="Visualizar"><i class="fas fa-eye"></i></button>
                                            <button class="action-btn process" title="Processar"><i class="fas fa-check"></i></button>
                                            <button class="action-btn cancel" title="Cancelar"><i class="fas fa-times"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#2000</td>
                                    <td>Carlos Mendes</td>
                                    <td>18/05/2025</td>
                                    <td>R$ 327,82</td>
                                    <td>Boleto bancário</td>
                                    <td><span class="status paid">Pago</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn view" title="Visualizar"><i class="fas fa-eye"></i></button>
                                            <button class="action-btn ship" title="Enviar"><i class="fas fa-shipping-fast"></i></button>
                                            <button class="action-btn cancel" title="Cancelar"><i class="fas fa-times"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1999</td>
                                    <td>Ana Ferreira</td>
                                    <td>18/05/2025</td>
                                    <td>R$ 249,90</td>
                                    <td>PayPal</td>
                                    <td><span class="status processing">Processando</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn view" title="Visualizar"><i class="fas fa-eye"></i></button>
                                            <button class="action-btn ship" title="Enviar"><i class="fas fa-shipping-fast"></i></button>
                                            <button class="action-btn cancel" title="Cancelar"><i class="fas fa-times"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1998</td>
                                    <td>Roberto Almeida</td>
                                    <td>17/05/2025</td>
                                    <td>R$ 539,70</td>
                                    <td>Cartão de crédito</td>
                                    <td><span class="status shipped">Enviado</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn view" title="Visualizar"><i class="fas fa-eye"></i></button>
                                            <button class="action-btn track" title="Rastrear"><i class="fas fa-truck"></i></button>
                                            <button class="action-btn complete" title="Entregue"><i class="fas fa-check-circle"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1997</td>
                                    <td>Fernanda Costa</td>
                                    <td>16/05/2025</td>
                                    <td>R$ 127,92</td>
                                    <td>PIX</td>
                                    <td><span class="status delivered">Entregue</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn view" title="Visualizar"><i class="fas fa-eye"></i></button>
                                            <button class="action-btn invoice" title="Nota Fiscal"><i class="fas fa-file-invoice"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1996</td>
                                    <td>Pedro Santos</td>
                                    <td>15/05/2025</td>
                                    <td>R$ 89,90</td>
                                    <td>Cartão de crédito</td>
                                    <td><span class="status canceled">Cancelado</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn view" title="Visualizar"><i class="fas fa-eye"></i></button>
                                            <button class="action-btn restore" title="Restaurar"><i class="fas fa-undo"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div class="pagination">
                            <button class="pagination-btn" disabled><i class="fas fa-angle-left"></i></button>
                            <button class="pagination-btn active">1</button>
                            <button class="pagination-btn">2</button>
                            <button class="pagination-btn">3</button>
                            <span class="pagination-ellipsis">...</span>
                            <button class="pagination-btn">15</button>
                            <button class="pagination-btn"><i class="fas fa-angle-right"></i></button>
                        </div>
                    </div>
                    
                    <!-- Modal de Detalhes do Pedido -->
                    <div class="modal" id="order-details-modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>Detalhes do Pedido #2001</h3>
                                <button class="close-modal"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="order-info">
                                    <div class="order-status">
                                        <h4>Status do Pedido</h4>
                                        <select class="status-select">
                                            <option value="pending">Pendente</option>
                                            <option value="paid">Pago</option>
                                            <option value="processing">Em processamento</option>
                                            <option value="shipped">Enviado</option>
                                            <option value="delivered">Entregue</option>
                                            <option value="canceled">Cancelado</option>
                                        </select>
                                        <button class="btn-primary btn-small">Atualizar</button>
                                    </div>
                                    
                                    <div class="info-columns">
                                        <div class="info-column">
                                            <h4>Informações do Cliente</h4>
                                            <p><strong>Nome:</strong> Maria Silva</p>
                                            <p><strong>Email:</strong> maria@email.com</p>
                                            <p><strong>Telefone:</strong> (11) 98765-4321</p>
                                            <p><strong>Cliente desde:</strong> 10/01/2025</p>
                                        </div>