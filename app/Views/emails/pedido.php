<h2>Olá, <?= esc($nome) ?>!</h2>

<p>Recebemos seu pedido. Aqui está o resumo:</p>

<ul>
    <?php foreach ($carrinho as $item): ?>
        <li>
            <?= esc($item['quantidade']) ?>x <?= esc($item['nome']) ?>
            — R$<?= number_format($item['preco'], 2, ',', '.') ?>
        </li>
    <?php endforeach; ?>
</ul>

<p>
    <strong>Subtotal:</strong> R$<?= number_format($subtotal, 2, ',', '.') ?><br>
    <strong>Frete:</strong> R$<?= number_format($frete, 2, ',', '.') ?><br>
    <strong>Desconto:</strong> -R$<?= number_format($desconto, 2, ',', '.') ?><br>
    <strong>Total:</strong> R$<?= number_format($total, 2, ',', '.') ?>
</p>

<p>
    <strong>Endereço de entrega:</strong><br>
    <?= esc($endereco) ?>
</p>

<p>Obrigado por comprar conosco!</p>
