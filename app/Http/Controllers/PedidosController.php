<?php

namespace App\Http\Controllers;

use App\Models\mensagem_externa;
use App\Models\Pedido;

class PedidosController extends Controller
{
    //
    protected $meus_pedidos;
    protected $cliente_id;
    protected $mensagem;

    public function __construct(Pedido $model, mensagem_externa $sms)
    {
        $this->meus_pedidos=$model;
        $this->mensagem=$sms;
        $this->cliente_id=Auth()->user()->id;
    }

    public function index(){
        $pedidos=$this->meus_pedidos->with('produtos', 'clientes')->where('cliente_id',$this->cliente_id)->get();
        return response()->json($pedidos);
    }

    public function buscar_meu_pedido($id){
        $pedidos=$this->meus_pedidos->with('produtos', 'clientes')->where('cliente_id',$this->cliente_id)->where('id', $id)->get();
        return response()->json($pedidos);
    }

    public function desfazerPedido($id){
        $pedidos=$this->meus_pedidos->find($id)->delete();
        if(asset($pedidos)){
            return response()->json('O seu pedido foi descartado com sucesso...');
        }
        
    }
    public function pedidos(){
        $pedidos=$this->meus_pedidos->with('produtos', 'clientes')->get();
        if(asset($pedidos)){
            return response()->json($pedidos);
        }
        
    }

    public function mensagem(){
        $mensagem=$this->mensagem->orderBy('created_at', 'desc')->get();
        if(asset($mensagem)){
            return response()->json($mensagem);
        }
        
    }

    public function marcarLida($id){
        $mensagem=$this->mensagem->find($id)->delete();
        if(asset($mensagem)){
            $updateList=$this->mensagem->orderBy('created_at', 'desc')->get();
            return response()->json($updateList);
        }
        
    }


    public function marcarLidaNotify($id){

        $mensagem=$this->meus_pedidos->find($id)->delete();
        if(asset($mensagem)){
            $pedidos=$this->meus_pedidos->with('produtos', 'clientes')->get();
            return response()->json($pedidos);
        }
        
    }

    public function detalhes_pedido($id){
        $pedidos=$this->meus_pedidos->with('produtos', 'clientes')->find($id);
        if(asset($pedidos)){
            return response()->json($pedidos);
        }
        
    }
}
