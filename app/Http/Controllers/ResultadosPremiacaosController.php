<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\ResultadosPremiacao;
use App\Helpers\Rest;
use App\Helpers\Result;
use App\Helpers\Helper;
use Response;
use Input;
use Illuminate\Support\Collection;

class ResultadosPremiacaosController extends Controller
{
    public function index(Request $request){
        try
        {
            $rest = new Rest();
            $rest->model = 'App\Models\ResultadosPremiacao';
            $rest->input = $request->toArray();

            $builder = $rest->getBuilder();
            $responseBd = $rest->getCollection('paginate', null);
            $result = $responseBd['result'];

            return Response::json($responseBd, $result->code);
        }

        catch(ModelNotFoundException $e)
        {
            $response = [];

            $result = new Result();
            $result->setCode(404);
            $result->internalMessage = $e->getMessage();

            $response['result'] = $result;

            return Response::json($response, $response['result']->code);
        }
    }
//-------------------------------------------------
    public function update(Request $request, $id){
        $result = new Result();

        try
        {
            try
            {
                $recurso = ResultadosPremiacao::findOrFail($id);
                $newresource = $request->toarray();
                                
                $data_update = $newresource['records'][0];

                if(array_key_exists('ataque',$data_update))
                    $recurso->ataque = $data_update['ataque'];
                if(array_key_exists('defesa',$data_update))
                    $recurso->defesa = $data_update['defesa'];
                if(array_key_exists('artilheiro',$data_update))
                    $recurso->artilheiro = $data_update['artilheiro'];

                $recurso->save();

                $response['records'] = $recurso;

                return Response::json($response, 200);
            }

            catch(ModelNotFoundException $e)
            {
                $response = [];

                $result->setCode(404);
                $result->internalMessage = $e->getMessage();

                $response['result'] = $result;

                return Response::json($response, $response['result']->code);
            }
        }

        catch(ModelNotFoundException $e)
        {
            $response = [];

            $result->setCode(404);
            $result->internalMessage = $e->getMessage();

            $response['result'] = $result;

            return Response::json($response, $response['result']->code);
        }
    }
//-------------------------------------------------
public function store(Request $request){
    $model = new \App\Models\ResultadosPremiacao();

    $model->ataque = null;
    $model->defesa = null;
    $model->artilheiro = null;

    $model->save();

    return "sucess";
}


    static public function getResults(){
        $rest = new Rest();
        $rest->model = 'App\Models\ResultadosPremiacao';
        $rest->input = [];

        $builder = $rest->getBuilder();
        $responseBd = $rest->getCollection('paginate', null);
        $result = $responseBd['result'];

        $resultados = $responseBd['records'];

        return $resultados;
    }   
}
