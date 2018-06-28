<?php
namespace App\Http\Controllers;
//-------------------------------------------------
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Participantes;
use App\Models\ApostasPremiacao;
use App\Helpers\Rest;
use App\Helpers\Result;
use Response;
use Input;
//-------------------------------------------------
class ApostasPremiacaosController extends Controller
{
    public function update(Request $request, $participante){
        $result = new Result();

        try
        {
            Participantes::findOrFail($participante);

            try
            {
                $recurso = ApostasPremiacao::where('participante_id', $participante)->first();
                $newresource = $request->toarray();

                $data_update = $newresource['records'][0];

                if(array_key_exists('artilheiro',$data_update))
                    $recurso->artilheiro = $data_update['artilheiro'];
                if(array_key_exists('ataque',$data_update))
                    $recurso->ataque = $data_update['ataque'];
                if(array_key_exists('defesa',$data_update))
                    $recurso->defesa = $data_update['defesa'];
                
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