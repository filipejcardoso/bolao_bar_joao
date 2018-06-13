<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Jogadores;
use App\Helpers\Rest;
use App\Helpers\Result;
use App\Helpers\Helper;
use Response;
use Input;
use Illuminate\Support\Collection;

class JogadoresController extends Controller
{
    public function index(Request $request){
        try
        {
            $rest = new Rest();
            $rest->model = 'App\Models\Jogadores';
            $rest->input = $request->toArray();

            $builder = $rest->getBuilder();
            $responseBd = $rest->getCollection('paginate', null);
            $result = $responseBd['result'];

            $response['records'] = [];
            $response['result'] = $responseBd['result'];
            
            foreach($responseBd['records']  as $time)
            {
                $time_aux['id'] = $time['id'];
                $time_aux['nome'] = $time['nome'];
                $time_aux['foto'] = $time['foto'];

                array_push($response['records'], $time_aux);
            }

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
}
