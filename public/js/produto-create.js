$(document).ready(function () {
    $('#preco').on('input', function () {
        let value = this.value;
        if (value) {
            this.value = parseFloat(value).toFixed(2);
        }
    });

    $('form').on('submit', function (e) {
        let nome = $('#nome').val().trim();
        let preco = $('#preco').val();
        let quantidade = $('#quantidade').val();

        if (!nome) {
            alert('Por favor, informe o nome do produto.');
            e.preventDefault();
            return false;
        }

        if (!preco || parseFloat(preco) <= 0) {
            alert('Por favor, informe um preço válido.');
            e.preventDefault();
            return false;
        }

        if (!quantidade || parseInt(quantidade) < 0) {
            alert('Por favor, informe uma quantidade válida.');
            e.preventDefault();
            return false;
        }
    });
});
