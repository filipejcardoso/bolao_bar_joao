<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\ResultadosFinais;
use App\Helpers\Rest;
use App\Helpers\Result;
use App\Helpers\Helper;
use Response;
use Input;
use Illuminate\Support\Collection;

class ResultadosFinaisController extends Controller
{
    public function index(Request $request){
        try
        {
            $rest = new Rest();
            $rest->model = 'App\Models\ResultadosFinais';
            $rest->input = $request->toArray();

            $builder = $rest->getBuilder();
            $responseBd = $rest->getCollection('paginate', null);
            $result = $responseBd['result'];

            $resultados['oitavas'] = [];
            $resultados['quartas'] = [];
            $resultados['semi'] = [];
            $resultados['final'] = [];
            $resultados['tquarto'] = [];

            foreach($responseBd['records'] as $resultado)
            {
                $resultado_aux['id'] = $resultado['id'];
                $resultado_aux['time_id'] = $resultado['time_id'];
                $resultado_aux['time'] = $resultado['time'];
                
                array_push($resultados[$resultado['fase']], $resultado_aux);
            }

            $response['records'] = $resultados;
            $response['result'] = $result;

            return Response::json($response, $result->code);
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
                $recurso = ResultadosFinais::findOrFail($id);
                $newresource = $request->toarray();
                
                $rest = new Rest();
                $rest->model = 'App\Models\ResultadosFinais';
                $rest->input = $newresource;
                $rest->instance = $recurso;
                
                $response = $rest->renew();
                $result = $response['result'];

                return Response::json($response, $result->code);
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

    $max = 8;
    for($i=1;$i<=($max*2);$i++)
    {
        $resultados_finais = new ResultadosFinais();
        $resultados_finais->fase = 'oitavas';
        $resultados_finais->save();
    }

    $max = 4;
    for($i=1;$i<=($max*2);$i++)
    {
        $resultados_finais = new ResultadosFinais();
        $resultados_finais->fase ='quartas';
        $resultados_finais->save();
    }

    $max = 2;
    for($i=1;$i<=($max*2);$i++)
    {
        $resultados_finais = new ResultadosFinais();
        $resultados_finais->fase = 'semi';
        $resultados_finais->save();
    }

    $max = 1;
    for($i=1;$i<=($max*2);$i++)
    {
        $resultados_finais = new ResultadosFinais();
        $resultados_finais->fase = 'final';
        $resultados_finais->save();
    }

    $max = 1;
    for($i=1;$i<=($max*2);$i++)
    {
        $resultados_finais = new ResultadosFinais();
        $resultados_finais->fase = 'tquarto';
        $resultados_finais->save();
    }

    $response['records'] = "ok";
    return Response::json($response, 200);
    }


    static public function getResults(){
            $rest = new Rest();
            $rest->model = 'App\Models\ResultadosFinais';
            $rest->input = [];
    
            $builder = $rest->getBuilder();
            $responseBd = $rest->getCollection('paginate', null);
            $result = $responseBd['result'];
    
            $resultados['oitavas'] = [];
            $resultados['quartas'] = [];
            $resultados['semi'] = [];
            $resultados['final'] = [];
            $resultados['tquarto'] = [];
    
            foreach($responseBd['records'] as $resultado)
            {
                $resultado_aux['id'] = $resultado['id'];
                $resultado_aux['time_id'] = $resultado['time_id'];
                $resultado_aux['time'] = $resultado['time'];
                
                array_push($resultados[$resultado['fase']], $resultado_aux);
            }
    
            return $resultados;
    }   
}
