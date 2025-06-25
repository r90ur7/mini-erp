# AdminLTE Integration - Mini ERP

## Sobre o AdminLTE

O AdminLTE é um template administrativo responsivo baseado em Bootstrap 4, especialmente projetado para criar interfaces de administração profissionais.
## Características do Layout Implementado

### 1. Layout Base (`layouts/admin.php`)
- **Sidebar responsiva** com navegação hierárquica
- **Header** com menu do usuário e toggle da sidebar
- **Footer** com informações de copyright
- **Preloader** para melhor UX durante carregamento
- **Integração com jQuery e Bootstrap 4**

### 2. Componentes Utilizados

#### Small Boxes (Dashboard)
Cards coloridos para exibir estatísticas e links rápidos:
```php
<div class="small-box bg-info">
    <div class="inner">
        <h3>Produtos</h3>
        <p>Gerenciar Catálogo</p>
    </div>
    <div class="icon">
        <i class="fas fa-box"></i>
    </div>
    <a href="/produto" class="small-box-footer">Ver Produtos <i class="fas fa-arrow-circle-right"></i></a>
</div>
```

#### Cards
Interface principal para conteúdo:
```php
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Título</h3>
        <div class="card-tools">
            <!-- Botões de ação -->
        </div>
    </div>
    <div class="card-body">
        <!-- Conteúdo -->
    </div>
    <div class="card-footer">
        <!-- Ações -->
    </div>
</div>
```

#### Tabelas Responsivas
```php
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <!-- Conteúdo da tabela -->
    </table>
</div>
```

### 3. Como Usar em Novas Views

Para criar uma nova view usando o layout AdminLTE:

```php
<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<!-- Seu conteúdo aqui -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Título da Página</h3>
            </div>
            <div class="card-body">
                <!-- Conteúdo da página -->
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Scripts específicos da página -->
<script>
// JavaScript personalizado
</script>
<?= $this->endSection() ?>
```

### 4. Variáveis Disponíveis no Layout

- `$title` - Título da página (aparece no `<title>`)
- `$page_title` - Título no cabeçalho da página
- `$breadcrumb` - Array com navegação breadcrumb

Exemplo de uso no controller:
```php
$data = [
    'title' => 'Lista de Produtos',
    'page_title' => 'Gerenciamento de Produtos',
    'breadcrumb' => [
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Produtos', 'url' => '/produto'],
        ['name' => 'Lista']
    ],
    'produtos' => $produtos
];

return view('produtos/index', $data);
```

### 5. Classes CSS Importantes

#### Cores dos Botões
- `btn-primary` - Azul (ação principal)
- `btn-success` - Verde (sucesso/confirmação)
- `btn-warning` - Amarelo (atenção)
- `btn-danger` - Vermelho (exclusão/erro)
- `btn-info` - Azul claro (informação)
- `btn-secondary` - Cinza (ação secundária)

#### Cores dos Small Boxes
- `bg-primary` - Azul
- `bg-success` - Verde
- `bg-warning` - Amarelo
- `bg-danger` - Vermelho
- `bg-info` - Azul claro

#### Alertas
- `alert-info` - Informação
- `alert-success` - Sucesso
- `alert-warning` - Atenção
- `alert-danger` - Erro

### 6. Ícones Font Awesome

O layout inclui Font Awesome 6.0.0 com milhares de ícones:
- `fas fa-home` - Casa
- `fas fa-box` - Caixa/Produto
- `fas fa-shopping-cart` - Carrinho
- `fas fa-user` - Usuário
- `fas fa-cog` - Configurações
- `fas fa-plus` - Adicionar
- `fas fa-edit` - Editar
- `fas fa-trash` - Excluir

### 7. JavaScript e jQuery

O layout inclui:
- jQuery 3.6.0
- Bootstrap 4.6.2
- AdminLTE 3.2

Exemplo de uso:
```javascript
$(document).ready(function() {
    // Código jQuery aqui
});
```

### 8. Responsividade

O layout é totalmente responsivo:
- **Desktop**: Sidebar fixa, layout completo
- **Tablet**: Sidebar colapsável
- **Mobile**: Sidebar overlay

### 9. Customização

Para personalizar cores e estilos, edite o arquivo `layouts/admin.php` na seção `<style>`:

```css
.btn-primary {
    background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
    border: none;
}
```

## Próximos Passos

1. **Adicionar mais funcionalidades** ao dashboard (gráficos, estatísticas)
2. **Implementar sistema de usuários** (login/logout)
3. **Criar mais páginas** seguindo o padrão estabelecido
4. **Adicionar DataTables** para tabelas com paginação e busca
5. **Implementar notificações** (toasts, alerts)

## Recursos Úteis

- [Documentação AdminLTE](https://adminlte.io/docs/3.2/)
- [Font Awesome Icons](https://fontawesome.com/icons)
- [Bootstrap 4 Documentation](https://getbootstrap.com/docs/4.6/)
- [jQuery Documentation](https://api.jquery.com/)
