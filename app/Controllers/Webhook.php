<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Pedido;
use App\Models\PedidoItens;

class Webhook extends BaseController
{
    public function pedidoStatus()
    {
        $pedidoId = $this->request->getPost('id');
        $status = $this->request->getPost('status');

        if (!$pedidoId || !$status) {
            return $this->response->setStatusCode(400)->setJSON(['erro' => 'ID e status são obrigatórios']);
        }

        $pedidoModel = new Pedido();

        $pedido = $pedidoModel->find($pedidoId);

        if (!$pedido) {
            return $this->response->setStatusCode(404)->setJSON(['erro' => 'Pedido não encontrado']);
        }

        if (strtolower($status) === 'cancelado') {
            // Remove itens primeiro (caso tenha FK)
            $itensModel = new PedidoItens();
            $itensModel->where('pedido_id', $pedidoId)->delete();

            // Remove o pedido
            $pedidoModel->delete($pedidoId);

            return $this->response->setJSON(['mensagem' => 'Pedido cancelado e removido com sucesso']);
        } else {
            // Atualiza status
            $pedidoModel->update($pedidoId, ['status' => $status]);

            return $this->response->setJSON(['mensagem' => 'Status do pedido atualizado com sucesso']);
        }
    }
    public function testar()
    {
        $pedidoModel = new Pedido();
        $pedidos = $pedidoModel->findAll();

        return view('webhook_test', ['pedidos' => $pedidos]);
    }
}