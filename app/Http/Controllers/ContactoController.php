<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageContactoRequest;
use App\Http\Requests\StorePageSobreRequest;
use App\Http\Requests\UpdatePageContactoRequest;
use App\Http\Requests\UpdatePageSobreRequest;
use App\Repositories\Contacto\ContactoRepositorio;
use Illuminate\Support\Facades\DB;

class ContactoController extends Controller
{
    //
    protected $repositirio;

    public function __construct(ContactoRepositorio $repo)
    {
        $this->repositirio=$repo;
    }

    public function pageContacto(){
        return $this->repositirio->getContacto();
    }
   
    public function createContacto(StorePageContactoRequest $request){
        return $this->repositirio->createContacto($request);
    }

    public function savePageSobre(StorePageSobreRequest $request){
        return $this->repositirio->savePageSobre($request);
    }

    public function updatePageContacto($id){
        return $this->repositirio->updatePageContacto($id);
    }

    public function updateSavePageSobre($id){
        return $this->repositirio->updateSavePageSobre($id);
    }

    public function updatePageContactoForm(UpdatePageContactoRequest $request, $id){
        return $this->repositirio->updatePageContactoForm($request, $id);
    }

    public function updateSavePageSobreForm(UpdatePageSobreRequest $request, $id){
        return $this->repositirio->updateSavePageSobreForm($request, $id);
    }
}
