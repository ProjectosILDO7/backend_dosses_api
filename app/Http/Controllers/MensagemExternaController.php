<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSendMessageRequest;
use App\Models\mensagem_externa;
use App\Repositories\MensagemExterna\MensagemExternaRepository;
use Illuminate\Http\Request;

class MensagemExternaController extends Controller
{
    protected $respositorio;

    public function __construct(MensagemExternaRepository $repo)
    {
        $this->respositorio=$repo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreSendMessageRequest $request)
    {
        //
        return $this->respositorio->send($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(mensagem_externa $mensagem_externa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(mensagem_externa $mensagem_externa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, mensagem_externa $mensagem_externa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mensagem_externa $mensagem_externa)
    {
        //
    }
}
