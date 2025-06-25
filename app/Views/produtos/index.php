<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-box mr-2"></i>
                    Lista de Produtos
                </h3>
                <div class="card-tools">
                    <a href="/produto/create" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus mr-1"></i> Novo Produto
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="60">ID</th>
                                <th>Nome</th>
                                <th width="120">Preço</th>
                                <th width="100">Quantidade</th>
                                <th width="140">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produtos as $produto): ?>
                                <tr>
                                    <td><?= $produto['id'] ?></td>
                                    <td><?= $produto['nome'] ?></td>
                                    <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                                    <td>
                                        <div class="input-group input-group-sm" style="width: 80px;">
                                            <input type="number" id="quantidade_<?= $produto['id'] ?>" value="1" min="1" max="<?= $produto['quantidade'] ?>" class="form-control form-control-sm">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="/produto/edit/<?= $produto['id'] ?>" class="btn btn-warning btn-sm" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-success btn-sm" title="Adicionar ao Carrinho" onclick="adicionarAoCarrinho(<?= $produto['id'] ?>)">
                                                <i class="fas fa-cart-plus"></i>
                                            </button>
                                            <a href="/produto/delete/<?= $produto['id'] ?>" class="btn btn-danger btn-sm" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-6">
                        <p class="text-muted mb-0">
                            Total de <?= count($produtos) ?> produto(s) encontrado(s)
                        </p>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="/carrinho/show" class="btn btn-info">
                            <i class="fas fa-shopping-cart mr-1"></i> Ir para o Carrinho
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="/js/produto-index.js"></script>
<?= $this->endSection() ?>