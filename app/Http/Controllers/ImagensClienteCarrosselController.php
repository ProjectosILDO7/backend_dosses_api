<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImagensClienteCarrosselController extends Controller
{
    //
    public function index(){
        $conteudo = DB::table('imagems')->get();
        return response()->json($conteudo);
    }
}
