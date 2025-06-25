<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? $title . ' - Mini ERP' : 'Mini ERP' ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    
    <style>
        .brand-link {
            background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
        }
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active {
            background-color: rgba(255,255,255,.1);
            color: #fff;
        }
        .content-wrapper {
            background-color: #f4f6f9;
        }
        .card {
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
        }
        .btn-primary {
            background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3 0%, #520dc2 100%);
            border: none;
        }
    </style>

    <?= $this->renderSection('styles') ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyIDJMMTMuMDkgOC4yNkwyMCA9TDEzLjA5IDE1Ljc0TDEyIDIyTDEwLjkxIDE1Ljc0TDQgOUwxMC45MSA4LjI2TDEyIDJaIiBmaWxsPSIjMDA3YmZmIi8+Cjwvc3ZnPgo=" alt="Logo" height="60" width="60">
    </div>

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">Configurações</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i> Perfil
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-cog mr-2"></i> Configurações
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-sign-out-alt mr-2"></i> Sair
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="/" class="brand-link">
            <i class="fas fa-cube brand-image" style="opacity: .8; color: white; margin-left: 10px;"></i>
            <span class="brand-text font-weight-light text-white">Mini ERP</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <i class="fas fa-user-circle fa-2x text-light"></i>
                </div>
                <div class="info">
                    <a href="#" class="d-block text-light">Administrador</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="/" class="nav-link <?= uri_string() == '' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item <?= strpos(uri_string(), 'produto') === 0 ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos(uri_string(), 'produto') === 0 ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-box"></i>
                            <p>
                                Produtos
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/produto" class="nav-link <?= uri_string() == 'produto' ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listar Produtos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/produto/create" class="nav-link <?= strpos(uri_string(), 'produto/create') === 0 ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Novo Produto</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item <?= strpos(uri_string(), 'carrinho') === 0 ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos(uri_string(), 'carrinho') === 0 ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                Carrinho
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/carrinho/show" class="nav-link <?= strpos(uri_string(), 'carrinho/show') === 0 ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ver Carrinho</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/carrinho/checkout" class="nav-link <?= strpos(uri_string(), 'carrinho/checkout') === 0 ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Checkout</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?= strpos(uri_string(), 'pedido') === 0 ? 'menu-open' : '' ?>">
                        <a href="/pedido/solicitados" class="nav-link <?= strpos(uri_string(), 'pedido/solicitados') === 0 ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Pedidos Solicitados</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?= isset($page_title) ? $page_title : 'Dashboard' ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <?php if (isset($breadcrumb)): ?>
                        <ol class="breadcrumb float-sm-right">
                            <?php foreach ($breadcrumb as $item): ?>
                                <?php if (isset($item['url'])): ?>
                                    <li class="breadcrumb-item"><a href="<?= $item['url'] ?>"><?= $item['name'] ?></a></li>
                                <?php else: ?>
                                    <li class="breadcrumb-item active"><?= $item['name'] ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ol>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>
        </section>
    </div>

    <?php if (session('sucesso')): ?>
    <div aria-live="polite" aria-atomic="true" style="position: fixed; top: 1rem; right: 1rem; z-index: 9999;">
        <div class="toast bg-success text-white show" id="toastSucesso" role="alert" data-autohide="false">
            <div class="toast-header bg-success text-white">
                <i class="fas fa-check-circle mr-2"></i>
                <strong class="mr-auto">Sucesso</strong>
                <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Fechar" style="float: right; opacity: 1;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                <?= session('sucesso') ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <footer class="main-footer">
        <strong>&copy; <?= date('Y') ?> <a href="/">Mini ERP</a>.</strong>
        Todos os direitos reservados.
        <div class="float-right d-none d-sm-inline-block">
            <b>Versão</b> 1.0.0
        </div>
    </footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<?= $this->renderSection('scripts') ?>

<script>
    $(window).on('load', function() {
        $('.preloader').fadeOut();
    });

    $(function() {
        if ($('#toastSucesso').length) {
            $('#toastSucesso').toast('show');
        }
    });
</script>

</body>
</html>
