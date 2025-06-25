<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Editar Produto
                </h3>
                <div class="card-tools">
                    <a href="/produto" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Voltar
                    </a>
                </div>
            </div>
            <form method="post" action="/produto/update/<?= $produto['id'] ?>">
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-1"></i>
                        <strong>ID do Produto:</strong> <?= $produto['id'] ?>
                    </div>

                    <div class="form-group">
                        <label for="nome">Nome do Produto <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= $produto['nome'] ?>" placeholder="Digite o nome do produto" required>
                        <small class="form-text text-muted">Informe um nome descritivo para o produto.</small>
                    </div>

                    <div class="form-group">
                        <label for="preco">Preço <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">R$</span>
                            </div>
                            <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="<?= $produto['preco'] ?>" placeholder="0,00" required>
                        </div>
                        <small class="form-text text-muted">Digite o preço no formato: 99.99</small>
                    </div>

                    <div class="form-group">
                        <label for="quantidade">Quantidade em Estoque <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?= $estoque['quantidade'] ?? 0 ?>" placeholder="0" min="0" required>
                        <small class="form-text text-muted">Quantidade disponível em estoque.</small>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="/produto" class="btn btn-secondary">
                                <i class="fas fa-times mr-1"></i> Cancelar
                            </a>
                        </div>
                        <div class="col-sm-6 text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Atualizar Produto
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="/js/produto-edit.js"></script>
<?= $this->endSection() ?>