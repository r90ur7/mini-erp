<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Teste Webhook Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h2 class="mb-4">🔁 Atualizar Status do Pedido</h2>

        <form id="webhook-form" class="mb-5">
            <div class="mb-3">
                <label for="id" class="form-label">ID do Pedido</label>
                <input type="number" class="form-control" id="id" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Novo Status</label>
                <input type="text" class="form-control" id="status" required>
            </div>
            <button type="submit" class="btn btn-primary">Alterar</button>
        </form>

        <div id="resultado" class="mb-4"></div>

        <h3>📋 Pedidos Atuais</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Atualizado em</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td><?= $pedido['id'] ?></td>
                        <td><?= esc($pedido['cliente_nome']) ?></td>
                        <td><?= esc($pedido['cliente_email']) ?></td>
                        <td><?= esc($pedido['status'] ?? 'pendente') ?></td>
                        <td>R$ <?= number_format($pedido['total'], 2, ',', '.') ?></td>
                        <td><?= $pedido['updated_at'] ?? '-' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        const form = document.getElementById('webhook-form');
        const resultado = document.getElementById('resultado');

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const id = document.getElementById('id').value;
            const status = document.getElementById('status').value;

            fetch('/webhook/pedido-status', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${encodeURIComponent(id)}&status=${encodeURIComponent(status)}`
            })
            .then(response => response.json())
            .then(data => {
                resultado.innerHTML = `<div class="alert alert-success">${data.mensagem || 'Atualizado com sucesso'}</div>`;
                setTimeout(() => location.reload(), 1500);
            })
            .catch(error => {
                resultado.innerHTML = `<div class="alert alert-danger">Erro: ${error}</div>`;
            });
        });
    </script>
</body>
</html>