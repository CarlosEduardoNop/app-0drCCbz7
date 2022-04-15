<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logProduto extends Model
{
    use HasFactory;
    protected $fillable = [
        'produto_id',
        'sku',
        'novo_sku',
        'quantidade',
        'quantidade_atual',
        'quantidade_anterior',
        'operacao'
    ];
}
