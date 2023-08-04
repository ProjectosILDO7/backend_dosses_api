<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mensagem_externa extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'telemovel',
        'email',
        'mensagem',
        'status'
    ];
}
