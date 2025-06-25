<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Produto;
use App\Models\Estoque;
use CodeIgniter\HTTP\ResponseInterface;

class ProdutoController extends BaseController
{
    public function index()
    {
        $produtoModel = new Produto();
        $estoqueModel = new Estoque();
        $produtos = $produtoModel->findAll();
        foreach ($produtos as &$produto) {
            $estoque = $estoqueModel->where('produto_id', $produto['id'])->first();
            $produto['quantidade'] = $estoque['quantidade'] ?? 0;
        }
        unset($produto);
        return view('produtos/index', ['produtos' => $produtos]);
    }

    public function create()
    {
        return view('produtos/create');
    }

    public function store()
    {
        $produtoModel = new Produto();
        $estoqueModel = new Estoque();

        $quantidade = $this->request->getPost('quantidade');
        if ($quantidade === null || $quantidade === '' || $quantidade < 0) {
            return redirect()->back()->withInput()->with('erro', 'Informe uma quantidade válida para o estoque.');
        }

        $produtoId = $produtoModel->insert([
            'nome'  => $this->request->getPost('nome'),
            'preco' => $this->request->getPost('preco'),
        ], true);

        if (!$produtoId) {
            return redirect()->back()->withInput()->with('erro', 'Erro ao salvar produto.');
        }

        if (!$estoqueModel->insert([
            'produto_id' => $produtoId,
            'quantidade' => $quantidade,
        ])) {
            $produtoModel->delete($produtoId);
            return redirect()->back()->withInput()->with('erro', 'Erro ao salvar estoque.');
        }

        return redirect()->to('/produto');
    }

    public function edit($id)
    {
        $produtoModel = new Produto();
        $estoqueModel = new Estoque();

        $data['produto'] = $produtoModel->find($id);
        $data['estoque'] = $estoqueModel->where('produto_id', $id)->first();

        return view('produtos/edit', $data);
    }

    public function update($id)
    {
        $produtoModel = new Produto();
        $estoqueModel = new Estoque();
    
        $produtoModel->update($id, [
            'nome'  => $this->request->getPost('nome'),
            'preco' => $this->request->getPost('preco'),
        ]);
    
        $estoqueModel
            ->where('produto_id', $id)
            ->set(['quantidade' => $this->request->getPost('quantidade')])
            ->update();
    
        return redirect()->to('/produto');
    }
    
    public function delete($id)
    {
        $produtoModel = new Produto();
        if (!$produtoModel->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Produto não encontrado");
        }
        $produtoModel->delete($id);

        return redirect()->to('/produto');
    }
}
