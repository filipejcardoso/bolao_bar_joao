<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultadosPremiacao extends Model
{
	protected $table = 'resultados_premiacaos';
    protected $primaryKey = 'id';
    protected $fillable = ['artilheiro','ataque','defesa'];

    static public function relacoes()
    {
        return ['artilheiro','ataque','defesa']; 
    }

    static public function relacoesModel()
    {
        return ['App\Models\Jogadores','App\Models\Times','App\Models\Times'];
    }

    public function artilheiro()
    {
        return $this->belongsTo('App\Models\Jogadores','artilheiro');
    }

    public function ataque()
    {
        return $this->belongsTo('App\Models\Times','ataque');
    }

    public function defesa()
    {
        return $this->belongsTo('App\Models\Times','defesa');
    }
}
