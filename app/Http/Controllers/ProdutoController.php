<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Repositories\Produto\ProdutoRepositorio;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    private $entety;

    public function __construct(ProdutoRepositorio $produto)
    {
        $this->entety=$produto;
    }

    public function index()
    {
     //
        return $this->entety->getProdutos();
    }

    public function produtosClientes()
    {
     //
        return $this->entety->getProdutosClientes();
    }

    // public function store(StoreProdutoRequest $request)
    // {
    //     return $this->entety->create($request);
    // }
    public function store(StoreProdutoRequest $request)
    {
        return $this->entety->create($request);
    }

    public function show($id)
    {
        //
        return $this->entety->detalhes($id);
    }
    public function pedirProduto($id)
    {
        //
        return $this->entety->pedirProduto($id);
    }


    public function edit($id)
    {

        return $this->entety->getProduto($id);
    }


    public function update(UpdateProdutoRequest $request, $id)
    {
        //
       return $this->entety->updateProduto($request, $id);
    }

    public function destroy($id)
    {
        //
        return $this->entety->apagar($id);
    }

}
