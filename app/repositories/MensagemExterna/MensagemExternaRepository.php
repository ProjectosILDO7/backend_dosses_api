<?php

namespace App\Repositories\MensagemExterna;

use App\Models\mensagem_externa;

class MensagemExternaRepository
{
    protected $entetySendMessage;

    public function __construct(mensagem_externa $send)
    {
        $this->entetySendMessage = $send;
    }

    public function send($data)
    {

        $sms = $this->entetySendMessage->create([
            'nome' => $data->nome,
            'telemovel' => $data->telemovel,
            'email' => $data->email,
            'mensagem' => $data->mensagem,
            'status'=>'0'
        ]);

        if (asset($sms)) {
            return response()->json($sms);
        }
    }
}
