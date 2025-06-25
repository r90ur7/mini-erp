$(function () {
    $('#cep').on('input blur', function (e) {
        let v = this.value.replace(/\D/g, '');
        if (v.length <= 8) v = v.replace(/(\d{5})(\d{0,3})/, '$1-$2');
        this.value = v;
        if (e.type === 'blur') {
            const cep = v.replace(/\D/g, '');
            $('#cep-error').hide().text('');
            if (cep.length === 8) {
                $('#endereco').val('Buscando...');
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(r => r.json()).then(d => {
                        if (!d.erro) {
                            $('#endereco').val(`${d.logradouro}, ${d.bairro} - ${d.localidade}/${d.uf}`);
                            setTimeout(() => {
                                $('#cidade option').filter((i, el) => $(el).text() === d.localidade)
                                    .prop('selected', true).trigger('change');
                                setTimeout(() => {
                                    $('#bairro option').filter((i, el) => $(el).text() === d.bairro)
                                        .prop('selected', true).trigger('change');
                                }, 800);
                            }, 800);
                        } else throw 'CEP não encontrado';
                    })
                    .catch(() => {
                        $('#endereco').val('');
                        $('#cep').val('').focus();
                        $('#cep-error').text('CEP inválido ou não encontrado.').show();
                    });
            }
        }
    });

    // Carrega municípios por UF
    $('#uf').on('change', function () {
        const uf = this.value;
        $('#cidade').prop('disabled', true).html('<option>Carregando cidades...</option>');
        $('#bairro').prop('disabled', true).html('<option>Selecione a cidade primeiro</option>');
        if (uf) {
            fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${uf}/municipios`)
                .then(r => r.json()).then(data => {
                    $('#cidade').prop('disabled', false).html('<option value="">Selecione a cidade</option>');
                    data.forEach(m => {
                        $('#cidade').append(`<option value="${m.id}" data-nome="${m.nome}">${m.nome}</option>`);
                    });
                })
                .catch(() => {
                    $('#cidade').prop('disabled', true).html('<option>Erro ao carregar cidades</option>');
                });
        } else {
            $('#cidade').prop('disabled', true).html('<option>Selecione a UF primeiro</option>');
        }
    });

    $('#cidade').on('change', function () {
        const cid = this.value;
        $('#bairro').prop('disabled', true).html('<option>Carregando bairros...</option>');
        if (cid) {
            fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/municipios/${cid}/distritos`)
                .then(r => r.json()).then(data => {
                    $('#bairro').prop('disabled', false).empty();
                    if (data.length) {
                        $('#bairro').append('<option value="">Selecione o bairro</option>');
                        data.forEach(d => {
                            $('#bairro').append(`<option value="${d.id}">${d.nome}</option>`);
                        });
                    } else {
                        $('#bairro').html('<option>Nenhum bairro encontrado</option>');
                    }
                })
                .catch(() => {
                    $('#bairro').prop('disabled', false).html('<option>Erro ao carregar bairros</option>');
                });
        } else {
            $('#bairro').prop('disabled', true).html('<option>Selecione a cidade primeiro</option>');
        }
    });

    // Aplicar cupom
    $('#aplicar-cupom').on('click', function () {
        const cupom = $('#cupom').val().trim();
        const subtotal = window.checkoutSubtotal || 0;
        const frete = window.checkoutFrete || 0;
        if (!cupom) return alert('Digite um cupom primeiro.');
        $(this).html('<i class="fas fa-spinner fa-spin mr-1"></i> Aplicando...');
        fetch('/carrinho/validar-cupom', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `cupom=${encodeURIComponent(cupom)}&subtotal=${subtotal}&frete=${frete}`
        })
            .then(r => r.json()).then(data => {
                $('#desconto-pedido').text(data.desconto.toLocaleString('pt-BR', { minimumFractionDigits: 2 }));
                $('#total-pedido').text(data.total.toLocaleString('pt-BR', { minimumFractionDigits: 2 }));
                alert(data.desconto > 0 ? 'Cupom aplicado!' : 'Cupom inválido ou expirado.');
            })
            .catch(() => alert('Erro ao validar cupom.'))
            .finally(() => $('#aplicar-cupom').html('<i class="fas fa-check mr-1"></i> Aplicar'));
    });

    // Validação geral
    $('form').on('submit', function (e) {
        const nome = $('#cliente_nome').val().trim();
        const email = $('#cliente_email').val().trim();
        const cep = $('#cep').val().replace(/\D/g, '');
        const endereco = $('#endereco').val().trim();

        if (!nome) { alert('Informe seu nome completo.'); e.preventDefault(); return; }
        if (!email || !/@/.test(email)) { alert('Informe um e‑mail válido.'); e.preventDefault(); return; }
        if (cep.length !== 8) { alert('Informe um CEP válido.'); e.preventDefault(); return; }
        if (!endereco || endereco === 'Buscando...') { alert('Aguarde o endereço ou preencha manualmente.'); e.preventDefault(); return; }
    });
});
