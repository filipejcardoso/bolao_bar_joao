<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultadosColocacao extends Model
{
	protected $table = 'resultados_colocacos';
    protected $primaryKey = 'id';
    protected $fillable = ['primeiro','segundo','terceiro','quarto'];

    static public function relacoes()
    {
        return ['primeiro','segundo','terceiro','quarto']; 
    }

    static public function relacoesModel()
    {
        return ['App\Models\Times','App\Models\Times','App\Models\Times','App\Models\Times'];
    }

    public function primeiro()
    {
        return $this->belongsTo('App\Models\Times','primeiro');
    }
    public function segundo()
    {
        return $this->belongsTo('App\Models\Times','segundo');
    }
    public function terceiro()
    {
        return $this->belongsTo('App\Models\Times','terceiro');
    }
    public function quarto()
    {
        return $this->belongsTo('App\Models\Times','quarto');
    }
}
