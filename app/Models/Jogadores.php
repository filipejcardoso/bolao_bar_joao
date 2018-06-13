<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jogadores extends Model
{
	protected $table = 'jogadores';
    protected $primaryKey = 'id';
    protected $fillable = ['nome','times'];

    static public function relacoes()
    {
        return []; 
    }

    static public function relacoesModel()
    {
        return [];
    }
}
