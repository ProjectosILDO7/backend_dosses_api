<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Repositories\Categoria\categoriaRepository;


class CategoriaController extends Controller
{
    private $entety;

    public function __construct(categoriaRepository $Categ)
    {
        $this->entety=$Categ;
    }

    public function index()
    {
     //
        return $this->entety->getCategorias();
    }

    public function store(StoreCategoriaRequest $request)
    {
        return $this->entety->create($request);
    }


    public function show($id)
    {
        //
        return $this->entety->detalhes($id);
    }

    public function edit($id)
    {

        return $this->entety->getCategoria($id);
    }

    public function update(UpdateCategoriaRequest $request, $id)
    {
        //
       return $this->entety->updateCategoria($request, $id);
    }

    public function destroy($id)
    {
        //
        return $this->entety->apagar($id);
    }
}
