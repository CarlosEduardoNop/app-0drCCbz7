<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logProduto extends Model
{
    use HasFactory;
    protected $fillable = ['sku', 'quantidade', 'quantidade_atual'];
}
