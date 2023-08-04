<?php

namespace App\Repositories\Sobre;

use App\Models\Sobre;

class SobreRepositorio
{

    private $user_id;
    private $entetySobre;

    public function __construct(Sobre $sobre)
    {
        $this->entetySobre=$sobre;
        $this->user_id = Auth()->user()->id;
    }

    public function getConteudoSobre()
    {
        $sobre = $this->entetySobre->where('user_id', $this->user_id)->get();
        return response()->json($sobre);
    }

    public function updateSavePageSobre($id)
    {
        $sobre = $this->entetySobre->find($id);
        return response()->json($sobre);
    }


    public function savePageSobre($data)
    {
        $sobre = $this->entetySobre->where('user_id', $this->user_id)->get();
        
        $contar=count($sobre);

        if ($contar !=0 ) {
            return response()->json(['Já existe um conteudo que fala de sua empresa...'],402);
        } else {
            $salvar =$this->entetySobre->create([
                'user_id'=>$this->user_id,
                'sobre'=>$data->sobre,
            ]);
            if(asset($salvar)){
                return response()->json($salvar);
            }
        }
    }


    public function updateSavePageSobreForm($request, $id)
    {
        $contacto =$this->entetySobre->find($id);

            $salvar = $contacto->update([
                'user_id'=>$this->user_id,
                'sobre'=>$request->sobre,
            ]);
            if(asset($salvar)){
                return response()->json($salvar);
            }

    }
}
