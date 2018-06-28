<?php
namespace App\Http\Controllers;
//-------------------------------------------------
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Participantes;
use App\Models\ApostasFinais;
use App\Helpers\Rest;
use App\Helpers\Result;
use Response;
use Input;
//-------------------------------------------------
class ApostasFinaisController extends Controller
{
    public function index(Request $request, $participante){
        try
        {
            Participantes::findOrFail($participante);

            $rest = new Rest();
            $rest->model = 'App\Models\ApostasFinais';
            $rest->input = $request->toArray();

            $builder = $rest->getBuilder();
            $builder = $builder->where('participante_id',$participante);
            $responseBd = $rest->getCollection('paginate', null);
            $result = $responseBd['result'];

            $apostas['oitavas'] = [];
            $apostas['quartas'] = [];
            $apostas['semi'] = [];
            $apostas['final'] = [];
            $apostas['tquarto'] = [];

            foreach($responseBd['records'] as $aposta)
            {
                $aposta_aux['id'] = $aposta['id'];
                $aposta_aux['time_id'] = $aposta['time_id'];
                $aposta_aux['time'] = $aposta['time'];
                
                array_push($apostas[$aposta['fase']], $aposta_aux);
            }

            $response['records'] = $apostas;
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
    public function update(Request $request, $participante, $id){
        $result = new Result();

        try
        {
            Participantes::findOrFail($participante);

            try
            {
                $recurso = ApostasFinais::findOrFail($id);
                $newresource = $request->toarray();
                
                $rest = new Rest();
                $rest->model = 'App\Models\ApostasFinais';
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
}