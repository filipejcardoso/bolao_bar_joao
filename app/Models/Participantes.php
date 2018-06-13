<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participantes extends Model
{
	protected $table = 'participantes';
    protected $primaryKey = 'id';
    protected $fillable = ['nome'];

    static public function relacoes()
    {
        return ['aposta','apostas_colocacao','apostas_finais','apostas_premiacao']; 
    }

    static public function relacoesModel()
    {
        return ['App\Models\Apostas','App\Models\ApostasColocacao','App\Models\ApostasFinais','App\Models\ApostasPremiacao'];
    }

    public function aposta()
    {
        return $this->hasMany('App\Models\Apostas','participante_id');
    }

    public function apostas_colocacao()
    {
        return $this->hasOne('App\Models\ApostasColocacao','participante_id');
    }

    public function apostas_finais()
    {
        return $this->hasMany('App\Models\ApostasFinais','participante_id');
    }

    public function apostas_premiacao()
    {
        return $this->hasOne('App\Models\ApostasPremiacao','participante_id');
    }
}
