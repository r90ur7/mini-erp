<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pedido;
use App\Models\PedidoItens;
use CodeIgniter\HTTP\ResponseInterface;

class PedidoController extends BaseController
{
    public function solicitados()
    {
        $pedidoModel = new Pedido();
        $pedidos = $pedidoModel->orderBy('created_at', 'DESC')->findAll(20);
        return view('pedidos/solicitados', ['pedidos' => $pedidos]);
    }

    public function atualizarStatus($id)
    {
        $pedidoModel = new Pedido();
        $status = $this->request->getPost('status');
        if (!in_array($status, ['pendente', 'a_caminho', 'entregue'])) {
            return $this->response->setStatusCode(400)->setJSON(['erro' => 'Status inválido']);
        }
        $pedidoModel->update($id, ['status' => $status]);
        return $this->response->setJSON(['sucesso' => true]);
    }
}
