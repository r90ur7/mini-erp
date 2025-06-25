$(function () {
    $(document).on('click', 'a[data-action="limpar-carrinho"]', function (e) {
        e.preventDefault();
        $('#modalLimparCarrinho').modal('show');
        $('#confirmLimparCarrinho').off('click').on('click', function () {
            window.location.href = '/carrinho/limpar';
        });
    });
});
