<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\ResultadosColocacao;
use App\Helpers\Rest;
use App\Helpers\Result;
use App\Helpers\Helper;
use Response;
use Input;
use Illuminate\Support\Collection;

class ResultadosColocacaosController extends Controller
{
    public function index(Request $request){
        try
        {
            $rest = new Rest();
            $rest->model = 'App\Models\ResultadosColocacao';
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
                $recurso = ResultadosColocacao::findOrFail($id);
                $newresource = $request->toarray();
                                
                $data_update = $newresource['records'][0];

                if(array_key_exists('primeiro',$data_update))
                    $recurso->primeiro = $data_update['primeiro'];
                if(array_key_exists('segundo',$data_update))
                    $recurso->segundo = $data_update['segundo'];
                if(array_key_exists('terceiro',$data_update))
                    $recurso->terceiro = $data_update['terceiro'];
                if(array_key_exists('quarto',$data_update))
                    $recurso->quarto = $data_update['quarto'];               

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
    $model = new \App\Models\ResultadosColocacao();

    $model->primeiro = null;
    $model->segundo = null;
    $model->terceiro = null;
    $model->quarto = null;

    $model->save();

    return "sucess";
}


    static public function getResults(){
        $rest = new Rest();
        $rest->model = 'App\Models\ResultadosColocacao';
        $rest->input = [];

        $builder = $rest->getBuilder();
        $responseBd = $rest->getCollection('paginate', null);
        $result = $responseBd['result'];

        $resultados = $responseBd['records'];

        return $resultados;
    }   
}
