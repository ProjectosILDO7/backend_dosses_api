<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $fillable=[
        'produto_id',
        'cliente_id',
        'status'
    ];

    public function produtos(){
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    public function clientes(){
        return $this->belongsTo(User::class, 'cliente_id');
    }
}
