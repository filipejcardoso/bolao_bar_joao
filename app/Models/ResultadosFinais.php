<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultadosFinais extends Model
{
	protected $table = 'resultados_finais';
    protected $primaryKey = 'id';
    protected $fillable = ['time_id'];

    static public function relacoes()
    {
        return ['time']; 
    }

    static public function relacoesModel()
    {
        return ['App\Models\Times'];
    }

    public function time()
    {
        return $this->belongsTo('App\Models\Times','time_id');
    }
}
