<?php

namespace App\Repositories\Categoria;

use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;

class categoriaRepository
{
    protected $ententy;
    protected $userID;

    public function __construct(Categoria $category)
    {
        $this->ententy = $category;
        $this->userID=Auth()->user()->id;
    }

    public function getCategorias()
    {
        $categoria = $this->ententy::orderBy('nome_categoria', 'asc')->get();
            if (asset($categoria)) {
                return response()->json($categoria);
            } else {
                return response()->json([
                    'status' => 'Erro',
                    'message' => 'Não foi possível carregar as categorias'
                ], 401);
            }
    }

    public function filtro($nome){
        
    }

    public function create($data)
    {

        $saveCategoria = $this->ententy::create([
            'nome_categoria' => $data['nome_categoria'],
        ]);

        if (asset($saveCategoria)) {
            return response()->json($saveCategoria);
        } else {
            return response()->json([
                'status' => 'Erro',
                'message' => 'Nao foi possível cadastrar este categoria. deve-se a um problema interno.!'
            ], 401);
        }
    }

    public function getCategoria($id)
    {
        //dd($id);
        $getCategoria = $this->ententy::find($id);
        if (asset($getCategoria)) {
            return response()->json([
                'getCategoria' => $getCategoria
            ], 200);
        } else {
            return response()->json([
                'message' => 'Categoria não encontrado..!'
            ], 401);
        }
    }

    public function updateCategoria($data, $id)
    {
        $updateCategoria = $this->ententy::find($id);
        
        $updateCategoria->nome_categoria = $data['nome_categoria'];
        $updateCategoria->save();

        if (asset($updateCategoria)) {
            return response()->json(['message' => 'A categoria foi actualizado com sucesso'], 200);
        } else {
            return response()->json(['Erro' => 'Não foi possível actualizar esta categoria'], 401);
        }
    }

    public function apagar($id)
    {
        $deleteCategoria = $this->ententy::find($id);
        $deleteCategoria->delete();

        if (asset($deleteCategoria)) {
            return response()->json(['message' => 'Esta categoria foi apagada com sucesso'], 200);
        } else {
            return response()->json(['erro' => 'Não foi possível apagar esta categoria'], 401);
        }
    }

    public function detalhes($id){
        $detalhes = $this->ententy::find($id);
        if(asset($detalhes)){
            return response()->json($detalhes);
        }else{
            return response()->json(['erro'=>'Não foi possível carregar os detalhes']);
        }
    }
}
