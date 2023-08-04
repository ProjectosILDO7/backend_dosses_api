<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageSobreRequest;
use App\Http\Requests\UpdatePageSobreRequest;
use App\Repositories\Sobre\SobreRepositorio;

class SobreController extends Controller
{
    //
    protected $repositorio;
    
    public function __construct(SobreRepositorio $repo)
    {
        $this->repositorio=$repo;;
    }

    public function savePageSobre(StorePageSobreRequest $request){
        return $this->repositorio->savePageSobre($request);
    }

    public function getConteudoSobre(){
        return $this->repositorio->getConteudoSobre();
    }

    public function updateSobreConteudoForm($id){
        return $this->repositorio->updateSavePageSobre($id);
    }

    public function updateSobreConteudo(UpdatePageSobreRequest $request, $id){
        return $this->repositorio->updateSavePageSobreForm($request, $id);
    }
}
