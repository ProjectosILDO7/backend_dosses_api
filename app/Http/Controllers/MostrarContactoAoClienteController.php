<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MostrarContactoAoClienteController extends Controller
{
    //
    public function getContactoEmpresa(){
        $contacto= DB::table('contactos')->first();
         return response()->json($contacto);
    }
}
