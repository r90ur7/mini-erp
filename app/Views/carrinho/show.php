<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-shopping-cart mr-2"></i>
                    Carrinho de Compras
                </h3>
                <div class="card-tools">
                    <a href="/produto" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Continuar Comprando
                    </a>
                </div>
            </div>
            <div class="card-body">
                <?php if (empty($carrinho)): ?>
                    <div class="alert alert-warning text-center">
                        <h4><i class="icon fas fa-exclamation-triangle"></i> Carrinho Vazio!</h4>
                        <p>Você ainda não adicionou nenhum produto ao seu carrinho.</p>
                        <a href="/produto" class="btn btn-primary">
                            <i class="fas fa-shopping-bag mr-1"></i> Ver Produtos
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Produto</th>
                                    <th width="120">Preço Unit.</th>
                                    <th width="80">Qtd</th>
                                    <th width="120">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($carrinho as $item): ?>
                                    <tr>
                                        <td>
                                            <strong><?= $item['nome'] ?></strong>
                                        </td>
                                        <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                                        <td>
                                            <span class="badge badge-primary"><?= $item['quantidade'] ?></span>
                                        </td>
                                        <td>
                                            <strong>R$ <?= number_format($item['preco'] * $item['quantidade'], 2, ',', '.') ?></strong>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Resumo do Pedido -->
                    <div class="row mt-4">
                        <div class="col-md-6 offset-md-6">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-calculator mr-1"></i>
                                        Resumo do Pedido
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <span>Subtotal:</span>
                                        <span>R$ <?= number_format($subtotal, 2, ',', '.') ?></span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Frete:</span>
                                        <span>R$ <?= number_format($frete, 2, ',', '.') ?></span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <strong>Total:</strong>
                                        <strong class="text-primary h5">R$ <?= number_format($total, 2, ',', '.') ?></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php if (!empty($carrinho)): ?>
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-6">
                        <a href="#" class="btn btn-outline-danger" data-action="limpar-carrinho">
                            <i class="fas fa-trash mr-1"></i> Limpar Carrinho
                        </a>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="/carrinho/checkout" class="btn btn-success btn-lg">
                            <i class="fas fa-credit-card mr-1"></i> Finalizar Compra
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalLimparCarrinho" tabindex="-1" aria-labelledby="modalLimparCarrinhoLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalLimparCarrinhoLabel"><i class="fas fa-exclamation-triangle mr-2"></i> Limpar Carrinho</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                    Tem certeza que deseja limpar o carrinho? Esta ação não pode ser desfeita.
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmLimparCarrinho">Limpar Carrinho</button>
                  </div>
                </div>
              </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="/js/carrinho-show.js"></script>
<?= $this->endSection() ?>