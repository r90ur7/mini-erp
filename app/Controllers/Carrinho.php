<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Produto;
use App\Models\Estoque;
use App\Models\Pedido;
use App\Models\PedidoItens;
use CodeIgniter\HTTP\ResponseInterface;

class Carrinho extends BaseController
{
    public function adicionar()
    {
        $session = session();
        $produtoModel = new Produto();
        $estoqueModel = new Estoque();

        $produto_id = $this->request->getPost('produto_id');
        $quantidade = (int) $this->request->getPost('quantidade');

        $produto = $produtoModel->find($produto_id);
        $estoque = $estoqueModel->where('produto_id', $produto_id)->first();

        if (!$produto || !$estoque || $estoque['quantidade'] < $quantidade) {
            return redirect()->to('/produto')->with('erro', 'Produto sem estoque suficiente.');
        }

        $carrinho = $session->get('carrinho') ?? [];

        if (isset($carrinho[$produto_id])) {
            $carrinho[$produto_id]['quantidade'] += $quantidade;
        } else {
            $carrinho[$produto_id] = [
                'id' => $produto['id'],
                'nome' => $produto['nome'],
                'preco' => $produto['preco'],
                'quantidade' => $quantidade
            ];
        }

        $session->set('carrinho', $carrinho);

        return redirect()->to('/carrinho/show');
    }

    public function show()
    {
        $session = session();
        $carrinho = $session->get('carrinho') ?? [];

        $subtotal = 0;
        foreach ($carrinho as $item) {
            $subtotal += $item['preco'] * $item['quantidade'];
        }

        if ($subtotal >= 52 && $subtotal <= 166.59) {
            $frete = 15.00;
        } elseif ($subtotal > 200) {
            $frete = 0.00;
        } else {
            $frete = 20.00;
        }

        return view('carrinho/show', [
            'carrinho' => $carrinho,
            'subtotal' => $subtotal,
            'frete' => $frete,
            'total' => $subtotal + $frete
        ]);
    }

    public function limpar()
    {
        session()->remove('carrinho');
        return redirect()->to('/carrinho/show');
    }

    public function checkout()
    {
        $session = session();
        $carrinho = $session->get('carrinho') ?? [];

        if (empty($carrinho)) {
            return redirect()->to('/carrinho/show')->with('erro', 'Carrinho vazio.');
        }

        $subtotal = 0;
        foreach ($carrinho as $item) {
            $subtotal += $item['preco'] * $item['quantidade'];
        }

        if ($subtotal >= 52 && $subtotal <= 166.59) {
            $frete = 15.00;
        } elseif ($subtotal > 200) {
            $frete = 0.00;
        } else {
            $frete = 20.00;
        }

        $desconto = 0;
        $cupom = null;
        $cupomCodigo = $session->getFlashdata('cupom') ?? null;
        if ($cupomCodigo) {
            $cupomModel = new \App\Models\Cupom();
            $cupom = $cupomModel->where('codigo', $cupomCodigo)
                                ->where('validade >=', date('Y-m-d'))
                                ->first();
            if ($cupom && $subtotal >= $cupom['minimo']) {
                $desconto = $cupom['desconto'];
            }
        }

        $total = $subtotal + $frete - $desconto;

        return view('carrinho/checkout', [
            'subtotal' => $subtotal,
            'frete' => $frete,
            'desconto' => $desconto,
            'total' => $total,
            'cupom' => $cupom
        ]);
    }

    public function finalizar()
    {
        $session = session();
        $carrinho = $session->get('carrinho') ?? [];

        if (empty($carrinho)) {
            return redirect()->to('/produto');
        }

        $subtotal = 0;
        foreach ($carrinho as $item) {
            $subtotal += $item['preco'] * $item['quantidade'];
        }

        if ($subtotal >= 52 && $subtotal <= 166.59) {
            $frete = 15.00;
        } elseif ($subtotal > 200) {
            $frete = 0.00;
        } else {
            $frete = 20.00;
        }
        $cupomCodigo = $this->request->getPost('cupom');
        $desconto = 0;

        if ($cupomCodigo) {
            $cupomModel = new \App\Models\Cupom();
            $cupom = $cupomModel->where('codigo', $cupomCodigo)
                            ->where('validade >=', date('Y-m-d'))
                            ->first();

            if ($cupom) {
                if ($subtotal >= $cupom['minimo']) {
                    $desconto = $cupom['desconto'];
                } else {
                    return redirect()->to('/carrinho/checkout')->with('erro', 'Cupom válido, mas subtotal mínimo não atingido.');
                }
            } else {
                return redirect()->to('/carrinho/checkout')->with('erro', 'Cupom inválido ou expirado.');
            }
        }


        $total = $subtotal + $frete - $desconto;

        $pedidoModel = new Pedido();
        $pedidoId = $pedidoModel->insert([
            'cliente_nome' => $this->request->getPost('cliente_nome'),
            'cliente_email' => $this->request->getPost('cliente_email'),
            'cep' => $this->request->getPost('cep'),
            'endereco' => $this->request->getPost('endereco'),
            'subtotal' => $subtotal,
            'frete' => $frete,
            'desconto' => $desconto,
            'total' => $total,
        ], true);

            $itemModel = new PedidoItens();
            $estoqueModel = new Estoque();

            foreach ($carrinho as $item) {
                $itemModel->insert([
                    'pedido_id' => $pedidoId,
                    'produto_id' => $item['id'],
                    'quantidade' => $item['quantidade'],
                    'preco' => $item['preco']
                ]);

                $estoqueModel->where('produto_id', $item['id'])
                            ->decrement('quantidade', $item['quantidade']);
            }

            $session->remove('carrinho');
            $email = \Config\Services::email();

            $email->setFrom('no-reply@minierp.local', 'Mini ERP');

            $email->setTo($this->request->getPost('cliente_email'));
            $email->setSubject('Seu pedido foi recebido!');

            $mensagem = view('emails/pedido', [
                'nome' => $this->request->getPost('cliente_nome'),
                'carrinho' => $carrinho,
                'subtotal' => $subtotal,
                'frete' => $frete,
                'desconto' => $desconto,
                'total' => $total,
                'endereco' => $this->request->getPost('endereco')
            ]);

            $email->setMessage($mensagem);
            $email->setMailType('html');

            if (!$email->send()) {
                log_message('error', 'Erro ao enviar e-mail: ' . print_r($email->printDebugger(['headers']), true));
            }

            return redirect()->to('/produto')->with('sucesso', 'Pedido finalizado com sucesso!');
        }

        public function validarCupom()
        {
            $cupomCodigo = $this->request->getPost('cupom');
            $subtotal = (float) $this->request->getPost('subtotal');
            $frete = (float) $this->request->getPost('frete');
            $desconto = 0;
            $cupom = null;
            $total = $subtotal + $frete;
            if ($cupomCodigo) {
                $cupomModel = new \App\Models\Cupom();
                $cupom = $cupomModel->where('codigo', $cupomCodigo)
                                    ->where('validade >=', date('Y-m-d'))
                                    ->first();
                if ($cupom && $subtotal >= $cupom['minimo']) {
                    $desconto = $cupom['desconto'];
                    $total = $subtotal + $frete - $desconto;
                }
            }
            return $this->response->setJSON([
                'desconto' => $desconto,
                'total' => $total
            ]);
        }
        
    }