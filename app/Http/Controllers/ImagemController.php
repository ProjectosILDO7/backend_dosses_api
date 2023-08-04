<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Repositories\ImagesCarrossel\ImagesRepository;

class ImagemController extends Controller
{
    //
    private $repositorio;

    public function __construct(ImagesRepository $rep)
    {
        $this->repositorio=$rep;    
    }

    public function createImage(StoreImageRequest $request){
        return $this->repositorio->createImage($request);
    }

    public function Images(){
        return $this->repositorio->Images();
    }
    public function detalhes($id){
        return $this->repositorio->detalhes($id);
    }

    public function apagarImagem($id){
        return $this->repositorio->apagarImagem($id);
    }
}
