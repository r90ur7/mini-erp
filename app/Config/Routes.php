<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/produto', 'ProdutoController::index');
$routes->get('/produto/create', 'ProdutoController::create');
$routes->post('/produto/store', 'ProdutoController::store');
$routes->get('/produto/edit/(:num)', 'ProdutoController::edit/$1');
$routes->post('/produto/update/(:num)', 'ProdutoController::update/$1');
$routes->get('/produto/delete/(:num)', 'ProdutoController::delete/$1');
$routes->post('/carrinho/adicionar', 'Carrinho::adicionar');
$routes->get('/carrinho/show', 'Carrinho::show');
$routes->get('/carrinho/limpar', 'Carrinho::limpar');
$routes->get('/carrinho/checkout', 'Carrinho::checkout');
$routes->post('/carrinho/finalizar', 'Carrinho::finalizar');
$routes->post('/carrinho/validar-cupom', 'Carrinho::validarCupom');
$routes->post('webhook/pedido-status', 'Webhook::pedidoStatus');
$routes->get('pedido/solicitados', 'PedidoController::solicitados');
$routes->post('pedido/atualizar-status/(:num)', 'PedidoController::atualizarStatus/$1');
// $routes->get('webhook/testar', 'Webhook::testar');

// Rota temporária para teste de email
// $routes->get('/teste-email', 'Home::testeEmail');