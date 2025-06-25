<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - Mini ERP' : 'Mini ERP' ?></title>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    
    <!-- CoreUI CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.2.6/dist/css/coreui.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@coreui/icons@3.0.1/css/all.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        .sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar-brand {
            background: rgba(255, 255, 255, 0.1);
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
        }
        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }
        .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
        }
        .header {
            background: #fff;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
        }
        .main {
            padding: 1rem;
        }
        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: 1px solid rgba(0, 0, 0, 0.125);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        }
    </style>
</head>
<body>
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-md-flex">
            <div class="sidebar-brand-full">
                <i class="fas fa-cube"></i>
                <strong>Mini ERP</strong>
            </div>
            <div class="sidebar-brand-minimized">
                <i class="fas fa-cube"></i>
            </div>
        </div>
        
        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
            <li class="nav-item">
                <a class="nav-link <?= uri_string() == '' ? 'active' : '' ?>" href="/">
                    <i class="nav-icon fas fa-home"></i> Dashboard
                </a>
            </li>
            
            <li class="nav-group">
                <a class="nav-link nav-group-toggle" href="#">
                    <i class="nav-icon fas fa-box"></i> Produtos
                </a>
                <ul class="nav-group-items">
                    <li class="nav-item">
                        <a class="nav-link <?= strpos(uri_string(), 'produto') === 0 && !strpos(uri_string(), 'create') ? 'active' : '' ?>" href="/produto">
                            <span class="nav-icon"></span> Listar Produtos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= strpos(uri_string(), 'produto/create') === 0 ? 'active' : '' ?>" href="/produto/create">
                            <span class="nav-icon"></span> Novo Produto
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="nav-group">
                <a class="nav-link nav-group-toggle" href="#">
                    <i class="nav-icon fas fa-shopping-cart"></i> Carrinho
                </a>
                <ul class="nav-group-items">
                    <li class="nav-item">
                        <a class="nav-link <?= strpos(uri_string(), 'carrinho/show') === 0 ? 'active' : '' ?>" href="/carrinho/show">
                            <span class="nav-icon"></span> Ver Carrinho
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= strpos(uri_string(), 'carrinho/checkout') === 0 ? 'active' : '' ?>" href="/carrinho/checkout">
                            <span class="nav-icon"></span> Checkout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>

    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <header class="header header-sticky mb-4">
            <div class="container-fluid">
                <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="header-nav d-none d-md-flex ms-auto">
                    <div class="nav-item dropdown">
                        <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-md">
                                <i class="fas fa-user-circle fa-2x text-muted"></i>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pt-0 pr-0 w-auto">
                            <div class="dropdown-header bg-light py-2">
                                <strong>Conta</strong>
                            </div>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user me-2"></i> Perfil
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cog me-2"></i> Configurações
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-sign-out-alt me-2"></i> Sair
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                <?php if (isset($breadcrumb)): ?>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php foreach ($breadcrumb as $item): ?>
                            <?php if (isset($item['url'])): ?>
                                <li class="breadcrumb-item"><a href="<?= $item['url'] ?>"><?= $item['name'] ?></a></li>
                            <?php else: ?>
                                <li class="breadcrumb-item active" aria-current="page"><?= $item['name'] ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ol>
                </nav>
                <?php endif; ?>

                <?= $this->renderSection('content') ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span>&copy; <?= date('Y') ?> Mini ERP. Todos os direitos reservados.</span>
                    </div>
                    <div class="col-md-6 text-end">
                        <span>Powered by CoreUI</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- CoreUI JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.2.6/dist/js/coreui.bundle.min.js"></script>
    
    <!-- Bootstrap JavaScript (se necessário) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <?= $this->renderSection('scripts') ?>
</body>
</html>
