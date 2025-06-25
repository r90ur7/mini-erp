<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>Produtos</h3>
                <p>Gerenciar Catálogo</p>
            </div>
            <div class="icon">
                <i class="fas fa-box"></i>
            </div>
            <a href="/produto" class="small-box-footer">Ver Produtos <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>Carrinho</h3>
                <p>Visualizar Compras</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="/carrinho/show" class="small-box-footer">Ver Carrinho <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>Novo</h3>
                <p>Cadastrar Produto</p>
            </div>
            <div class="icon">
                <i class="fas fa-plus-circle"></i>
            </div>
            <a href="/produto/create" class="small-box-footer">Adicionar <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>Checkout</h3>
                <p>Finalizar Compra</p>
            </div>
            <div class="icon">
                <i class="fas fa-credit-card"></i>
            </div>
            <a href="/carrinho/checkout" class="small-box-footer">Finalizar <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>Pedidos</h3>
                <p>Solicitados Agora</p>
            </div>
            <div class="icon">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <a href="/pedido/solicitados" class="small-box-footer">Ver Pedidos <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <section class="col-lg-7 connectedSortable">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-home mr-1"></i>
                    Bem-vindo ao Mini ERP
                </h3>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h5><i class="icon fas fa-info"></i> Sistema de Gestão!</h5>
                    <strong>Mini ERP</strong> é um sistema simples e eficiente para controle de produtos, estoque e pedidos.
                    Utilize o menu lateral para navegar entre as principais funcionalidades do sistema.
                </div>

                <p class="text-muted">
                    O sistema oferece funcionalidades completas para:
                </p>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check text-success mr-2"></i> Gerenciamento de produtos</li>
                    <li><i class="fas fa-check text-success mr-2"></i> Controle de estoque</li>
                    <li><i class="fas fa-check text-success mr-2"></i> Carrinho de compras</li>
                    <li><i class="fas fa-check text-success mr-2"></i> Processo de checkout</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="col-lg-5 connectedSortable">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-route mr-1"></i>
                    Rotas Disponíveis
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Rota</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code>/produto</code></td>
                                <td><a href="/produto" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a></td>
                            </tr>
                            <tr>
                                <td><code>/produto/create</code></td>
                                <td><a href="/produto/create" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></a></td>
                            </tr>
                            <tr>
                                <td><code>/carrinho/show</code></td>
                                <td><a href="/carrinho/show" class="btn btn-info btn-sm"><i class="fas fa-shopping-cart"></i></a></td>
                            </tr>
                            <tr>
                                <td><code>/carrinho/checkout</code></td>
                                <td><a href="/carrinho/checkout" class="btn btn-warning btn-sm"><i class="fas fa-credit-card"></i></a></td>
                            </tr>
                            <tr>
                                <td><code>/pedido/solicitados</code></td>
                                <td><a href="/pedido/solicitados" class="btn btn-primary btn-sm"><i class="fas fa-clipboard-list"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bolt mr-1"></i>
                    Ações Rápidas
                </h3>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="/produto/create" class="btn btn-primary mb-2">
                        <i class="fas fa-plus mr-1"></i> Cadastrar Novo Produto
                    </a>
                    <a href="/produto" class="btn btn-outline-primary mb-2">
                        <i class="fas fa-list mr-1"></i> Ver Todos os Produtos
                    </a>
                    <a href="/carrinho/show" class="btn btn-outline-success">
                        <i class="fas fa-shopping-basket mr-1"></i> Acessar Carrinho
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
