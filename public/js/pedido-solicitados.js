$(document).ready(function () {
    $('.status-select').change(function () {
        var pedidoId = $(this).data('id');
        var status = $(this).val();
        $.post('/pedido/atualizar-status/' + pedidoId, { status: status }, function (resp) {
        }).fail(function (xhr) {
            alert('Erro ao atualizar status: ' + (xhr.responseJSON?.erro || 'Erro desconhecido'));
        });
    });
});
