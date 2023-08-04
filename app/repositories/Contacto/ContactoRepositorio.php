<?php

namespace App\Repositories\Contacto;

use App\Models\Contacto;
use App\Models\Sobre;
use Illuminate\Support\Facades\DB;

class ContactoRepositorio
{

    private $entety;
    private $user_id;
    private $entetySobre;

    public function __construct(Contacto $contacto, Sobre $sobre)
    {
        $this->entety = $contacto;
        $this->entetySobre=$sobre;
        $this->user_id = Auth()->user()->id;
    }

    public function getContacto()
    {
        $contacto = $this->entety::where('user_id', $this->user_id)->get();
        return response()->json($contacto);
    }

    public function updatePageContacto($id)
    {
        $contacto = $this->entety::find($id);
        return response()->json($contacto);
    }

    public function updateSavePageSobre($id)
    {
        $sobre = $this->entetySobre->find( $id);
        return response()->json($sobre);
    }

    public function createContacto($data)
    {
        $contacto = $this->entety::where('user_id', $this->user_id)->get();

        $contar=count($contacto);
        
        if ($contar !=0 ) {
            return response()->json(['Já existe contacto registado no sistema'],402);
        } else {
            $salvar = $this->entety::create([
                'user_id'=>$this->user_id,
                'facebook'=>$data->facebook,
                'link_facebook'=>$data->link_facebook,
                'youtube'=>$data->youtube,
                'link_youtube'=>$data->link_youtube,
                'whatsapp'=>$data->whatsapp
            ]);
            if(asset($salvar)){
                return response()->json($salvar);
            }
        }
    }

    public function savePageSobre($data)
    {
        $sobre = $this->entetySobre->where('user_id', $this->user_id)->get();

        $contar=count($sobre);
        return response()->json($contar);
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

    public function updatePageContactoForm($request, $id)
    {
        $contacto = $this->entety::find($id);

            $salvar = $contacto->update([
                'user_id'=>$this->user_id,
                'facebook'=>$request->facebook,
                'link_facebooks'=>$request->link_facebook,
                'youtube'=>$request->youtube,
                'link_youtube'=>$request->link_youtube,
                'whatsapp'=>$request->whatsapp
            ]);
            if(asset($salvar)){
                return response()->json($salvar);
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
