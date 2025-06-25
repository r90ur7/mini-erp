function adicionarAoCarrinho(produtoId) {
    const input = document.getElementById('quantidade_' + produtoId);
    const quantidade = parseInt(input.value, 10);
    const max = parseInt(input.max, 10);
    if (!quantidade || quantidade < 1) {
        alert('Por favor, informe uma quantidade válida.');
        return;
    }
    if (quantidade > max) {
        alert('A quantidade máxima disponível em estoque é ' + max + '.');
        input.value = max;
        return;
    }
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/carrinho/adicionar';
    const inputProdutoId = document.createElement('input');
    inputProdutoId.type = 'hidden';
    inputProdutoId.name = 'produto_id';
    inputProdutoId.value = produtoId;
    form.appendChild(inputProdutoId);
    const inputQuantidade = document.createElement('input');
    inputQuantidade.type = 'hidden';
    inputQuantidade.name = 'quantidade';
    inputQuantidade.value = quantidade;
    form.appendChild(inputQuantidade);
    document.body.appendChild(form);
    form.submit();
}

$(document).ready(function () {
    $('input[id^="quantidade_"]').on('input', function () {
        const max = parseInt(this.max, 10);
        if (parseInt(this.value, 10) > max) {
            this.value = max;
        }
    });
    $('input[id^="quantidade_"]').on('keypress', function (e) {
        if (e.which === 13) {
            const produtoId = this.id.replace('quantidade_', '');
            adicionarAoCarrinho(produtoId);
        }
    });
    $('input[id^="quantidade_"]').on('focus', function () {
        this.select();
    });
});
