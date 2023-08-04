<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFuncionarioRequest;
use App\Http\Requests\UpdateclienteRequest;
use App\Http\Requests\UpdateFuncionarioRequest;
use App\Repositories\Funcionarios\FuncionarioRepository;
use Illuminate\Http\Request;

class funcionarioController extends Controller
{
    private $entety;

    public function __construct(FuncionarioRepository $func)
    {
        $this->entety=$func;
    }

    public function index()
    {
     //
        return $this->entety->getFuncionarios();
    }

    public function getClientes()
    {
     //
        return $this->entety->getClientes();
    }

    public function getClientePeloAdmin($id)
    {
     //
        return $this->entety->getClientePeloAdmin($id);
    }

    public function getReservas()
    {
     //
        return $this->entety->getReservas();
    }

    public function getMinhas_Reservas()
    {
     //
        return $this->entety->getMinhasReservas();
    }

    public function criar_reserva($id)
    {
     //
        return $this->entety->criar_reserva($id);
    }

    public function store(StoreFuncionarioRequest $request)
    {
        return $this->entety->create($request);
    }

    public function show($id)
    {
        //
        return $this->entety->detalhes($id);
    }

    public function detalhesClientes($id)
    {
        //
        return $this->entety->detalhesClientes($id);
    }


    public function edit($id)
    {

        return $this->entety->getFuncionario($id);
    }


    public function update(UpdateFuncionarioRequest $request, $id)
    {
        //
       return $this->entety->updateFuncionario($request, $id);
    }

    public function update2(UpdateclienteRequest $request, $id)
    {
        //
       return $this->entety->updateFuncionario($request, $id);
    }

    public function destroy($id)
    {
        //
        return $this->entety->apagar($id);
    }

    public function inativar($id)
    {
        //
        return $this->entety->inativar($id);
    }

    public function activo($id)
    {
        //
        return $this->entety->activo($id);
    }
}
