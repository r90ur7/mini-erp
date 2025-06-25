<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-credit-card mr-2"></i> Finalizar Pedido</h3>
        <div class="card-tools">
          <a href="/carrinho/show" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left mr-1"></i> Voltar ao Carrinho</a>
        </div>
      </div>
      <form method="post" action="/carrinho/finalizar">
        <div class="card-body">
          <h5 class="mb-3"><i class="fas fa-user mr-1"></i> Dados do Cliente</h5>
          <div class="row">
            <div class="col-md-6"><input type="text" class="form-control" id="cliente_nome" name="cliente_nome" required placeholder="Digite seu nome completo"></div>
            <div class="col-md-6"><input type="email" class="form-control" id="cliente_email" name="cliente_email" required placeholder="seu@email.com"></div>
          </div>

          <h5 class="mb-3 mt-4"><i class="fas fa-map-marker-alt mr-1"></i> Endereço de Entrega</h5>
          <div class="row">
            <div class="col-md-4">
              <input type="text" class="form-control" id="cep" name="cep" required placeholder="00000-000" maxlength="9">
              <div id="cep-error" class="invalid-feedback" style="display:none; font-size:1rem;"></div>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" id="endereco" name="endereco" required placeholder="Será preenchido automaticamente" readonly tabindex="-1" style="background:#f5f5f5; cursor:not-allowed;">
            </div>
          </div>

          <h5 class="mb-3 mt-4"><i class="fas fa-ticket-alt mr-1"></i> Cupom de Desconto</h5>
          <div class="input-group">
            <input type="text" class="form-control" id="cupom" name="cupom" placeholder="Digite o código">
            <div class="input-group-append"><button type="button" id="aplicar-cupom" class="btn btn-outline-secondary"><i class="fas fa-check mr-1"></i> Aplicar</button></div>
          </div>
          <div class="form-group mt-4"><textarea class="form-control" id="observacoes" name="observacoes" rows="3" placeholder="Comentários (opcional)"></textarea></div>
        </div>

        <div class="card-footer text-right">
          <a href="/carrinho/show" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i> Voltar</a>
          <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-check mr-1"></i> Finalizar Pedido</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-header"><h5 class="card-title mb-0"><i class="fas fa-calculator mr-1"></i> Resumo do Pedido</h5></div>
      <div class="card-body">
        <div class="d-flex justify-content-between"><span>Subtotal:</span><span>R$ <?= number_format($subtotal ?? 0,2,',','.') ?></span></div>
        <div class="d-flex justify-content-between"><span>Frete:</span><span>R$ <?= number_format($frete ?? 0,2,',','.') ?></span></div>
        <div class="d-flex justify-content-between"><span>Desconto:</span><span class="text-success">-R$ <span id="desconto-pedido"><?= number_format($desconto ?? 0,2,',','.') ?></span></span></div>
        <hr>
        <div class="d-flex justify-content-between"><strong>Total:</strong><strong class="text-primary h5">R$ <span id="total-pedido"><?= number_format($total ?? 0,2,',','.') ?></span></strong></div>
      </div>
      <div class="card-footer"><small class="text-info"><i class="fas fa-info-circle mr-1"></i> Revise todos os dados antes de finalizar.</small></div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
  window.checkoutSubtotal = <?= json_encode($subtotal ?? 0) ?>;
  window.checkoutFrete = <?= json_encode($frete ?? 0) ?>;
</script>
<script src="/js/checkout.js"></script>
<?= $this->endSection() ?>
