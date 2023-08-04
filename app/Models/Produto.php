<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $fillable = [
        'categoria_id',
        'nome_produto',
        'image_produto',
        'descricao',
        'preco',
        'receita'
    ];


    public function categorias(){
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function pedidos(){
        return $this->belongsTo(Pedido::class, 'produto_id');
    }
}
