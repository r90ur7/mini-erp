<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-clipboard-list mr-2"></i>
                    Pedidos Solicitados Agora
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Alterar Status</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pedidos as $pedido): ?>
                                <tr>
                                    <td><?= $pedido['id'] ?></td>
                                    <td><?= esc($pedido['cliente_nome']) ?></td>
                                    <td>R$ <?= number_format($pedido['total'], 2, ',', '.') ?></td>
                                    <td>
                                        <?php
                                            $statusLabel = [
                                                'pendente' => 'warning',
                                                'a_caminho' => 'info',
                                                'entregue' => 'success',
                                            ];
                                            $label = $statusLabel[$pedido['status']] ?? 'secondary';
                                        ?>
                                        <span class="badge badge-<?= $label ?>">
                                            <?= ucfirst(str_replace('_', ' ', $pedido['status'])) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <select class="form-control form-control-sm status-select" data-id="<?= $pedido['id'] ?>">
                                            <option value="pendente" <?= $pedido['status'] === 'pendente' ? 'selected' : '' ?>>Pendente</option>
                                            <option value="a_caminho" <?= $pedido['status'] === 'a_caminho' ? 'selected' : '' ?>>A Caminho</option>
                                            <option value="entregue" <?= $pedido['status'] === 'entregue' ? 'selected' : '' ?>>Entregue</option>
                                        </select>
                                    </td>
                                    <td><?= date('d/m/Y H:i', strtotime($pedido['created_at'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="/js/pedido-solicitados.js"></script>
<?= $this->endSection() ?>
