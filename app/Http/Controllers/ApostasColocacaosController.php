<?php
namespace App\Http\Controllers;
//-------------------------------------------------
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Participantes;
use App\Models\ApostasColocacao;
use App\Helpers\Rest;
use App\Helpers\Result;
use Response;
use Input;
//-------------------------------------------------
class ApostasColocacaosController extends Controller
{
    public function update(Request $request, $participante){
        $result = new Result();

        try
        {
            Participantes::findOrFail($participante);

            try
            {
                $recurso = ApostasColocacao::where('participante_id', $participante)->first();
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

                $result = new Result();
                $result->setCode(200);
                $result->internalMessage = "Apostas Atualizadas";

                $response['records'] = $recurso;
                $response['result'] = $result;
                
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