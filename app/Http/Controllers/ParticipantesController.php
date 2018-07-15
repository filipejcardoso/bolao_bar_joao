<?php
namespace App\Http\Controllers;
//-------------------------------------------------
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Participantes;
use App\Models\Jogos;
use App\Models\Apostas;
use App\Models\ApostasColocacao;
use App\Models\ApostasFinais;
use App\Models\ApostasPremiacao;
use App\Helpers\Rest;
use App\Helpers\Result;
use App\Helpers\Helper;
use Response;
use Input;
use Illuminate\Support\Collection;
//-------------------------------------------------
class ParticipantesController extends Controller
{

    public function index(Request $request){
        $rest = new Rest();
        $rest->model = 'App\Models\Participantes';
        $rest->input = $request->toArray();

        $builder = $rest->getBuilder();
        $responseBd = $rest->getCollection('paginate', null);
        $result = $responseBd['result'];

        $classificacao = [];

        $participante = [];
        foreach($responseBd['records'] as $p)
        {
            $participante['id'] = $p['id'];
            $participante['nome'] = $p['nome'];
            $participante['p'] = 0;
            $participante['pc'] = 0;
            $participante['pv'] = 0;
            $participante['pp'] = 0;
            $participante['av'] = 0;

            foreach($p['aposta'] as $aposta)
                if( $aposta['jogo']['status']>0)
                {
                    //PONTOS
                    $participante['p'] = $participante['p'] + $this->getPontos($aposta['escore1'], $aposta['escore2'], $aposta['jogo']['escore1'], $aposta['jogo']['escore2']);
                }
            
            //APOSTAS FINAIS
            $apostas_finais['oitavas'] = [];
            $apostas_finais['quartas'] = [];
            $apostas_finais['semi'] = [];
            $apostas_finais['final'] = [];
            $apostas_finais['tquarto'] = [];

            foreach($p['apostas_finais'] as $apostaF)
            {
                $final = json_decode($apostaF);
                $apostaF_aux['id'] = $final->id;
                $apostaF_aux['time_id'] = $final->time_id;
                
                if($final->time != null)
                    $apostaF_aux['time'] = $final->time->nome;
                else
                $apostaF_aux['time'] = $final->time;

                array_push($apostas_finais[$final->fase], $apostaF_aux);
            }

            $resultados = ResultadosFinaisController::getResults();

            foreach($resultados['oitavas'] as $r)
                foreach($apostas_finais['oitavas'] as $af)
                    if($af['time_id'] == $r['time_id'])
                        $participante['p'] = $participante['p'] + 2;

            foreach($resultados['quartas'] as $r)
                foreach($apostas_finais['quartas'] as $af)
                    if($af['time_id'] == $r['time_id'])
                        $participante['p'] = $participante['p'] + 3;

            foreach($resultados['semi'] as $r)
                foreach($apostas_finais['semi'] as $af)
                    if($af['time_id'] == $r['time_id'])
                        $participante['p'] = $participante['p'] + 4;

            foreach($resultados['tquarto'] as $r)
                foreach($apostas_finais['tquarto'] as $af)
                    if($af['time_id'] == $r['time_id'])
                        $participante['p'] = $participante['p'] + 5;

            foreach($resultados['final'] as $r)
                foreach($apostas_finais['final'] as $af)
                    if($af['time_id'] == $r['time_id'])
                        $participante['p'] = $participante['p'] + 6;


            //APOSTAS COLOCAÇÃO
            $resultados_colocacao = json_decode(ResultadosColocacaosController::getResults()[0]);
            $colocacaoF = json_decode($p['apostas_colocacao']);

            if($resultados_colocacao->primeiro->id == $colocacaoF->primeiro->id)
                $participante['p'] = $participante['p'] + 10;

            if($resultados_colocacao->segundo->id == $colocacaoF->segundo->id)
                $participante['p'] = $participante['p'] + 6;

            if($resultados_colocacao->terceiro->id == $colocacaoF->terceiro->id)
                $participante['p'] = $participante['p'] + 4;

            if($resultados_colocacao->quarto->id == $colocacaoF->quarto->id)
                $participante['p'] = $participante['p'] + 2;

            //APOSTAS PREMIAÇÃO
            $resultados_premiacao = json_decode(ResultadosPremiacaosController::getResults()[0]);
            $premiacaoF = json_decode($p['apostas_premiacao']);

            if($resultados_premiacao->artilheiro->id == $premiacaoF->artilheiro->id)
                $participante['p'] = $participante['p'] + 10;

            if($resultados_premiacao->ataque->id == $premiacaoF->ataque->id)
                $participante['p'] = $participante['p'] + 6;

            if($resultados_premiacao->defesa->id == $premiacaoF->defesa->id)
                $participante['p'] = $participante['p'] + 4;

            array_push($classificacao, $participante);
        }

        $cSort = Helper::sortCollectionDesc($classificacao, ['p','pc','pv','pp','av']);
        $response['records'] = $cSort;
        $response['result'] = $responseBd['result'];

        return Response::json($response, $result->code);
	}
//-------------------------------------------------    
public function quadro(Request $request){
        $rest = new Rest();
        $rest->model = 'App\Models\Participantes';
        $rest->input = $request->toArray();

        $builder = $rest->getBuilder();
        $builder->orderBy('nome');
        $responseBd = $rest->getCollection('paginate', null);
        $result = $responseBd['result'];

        $classificacao = [];

        $participante = [];
        foreach($responseBd['records'] as $p)
        {
            $participante['id'] = $p['id'];
            $participante['nome'] = $p['nome'];
            $participante['p'] = 0;
            $participante['pc'] = 0;
            $participante['pv'] = 0;
            $participante['pp'] = 0;
            $participante['av'] = 0;

            foreach($p['aposta'] as $aposta)
                if( $aposta['jogo']['status']>0)
                {
                    //PONTOS
                    $participante['p'] = $participante['p'] + $this->getPontos($aposta['escore1'], $aposta['escore2'], $aposta['jogo']['escore1'], $aposta['jogo']['escore2']);
                }
            //APOSTAS FINAIS
            $apostas_finais['oitavas'] = [];
            $apostas_finais['quartas'] = [];
            $apostas_finais['semi'] = [];
            $apostas_finais['final'] = [];
            $apostas_finais['tquarto'] = [];

            foreach($p['apostas_finais'] as $apostaF)
            {
                $final = json_decode($apostaF);
                $apostaF_aux['id'] = $final->id;
                $apostaF_aux['time_id'] = $final->time_id;
                
                if($final->time != null)
                    $apostaF_aux['time'] = $final->time->nome;
                else
                $apostaF_aux['time'] = $final->time;

                array_push($apostas_finais[$final->fase], $apostaF_aux);
            }

            $resultados = ResultadosFinaisController::getResults();

            foreach($resultados['oitavas'] as $r)
                foreach($apostas_finais['oitavas'] as $af)
                    if($af['time_id'] == $r['time_id'])
                        $participante['p'] = $participante['p'] + 2;

            foreach($resultados['quartas'] as $r)
                foreach($apostas_finais['quartas'] as $af)
                    if($af['time_id'] == $r['time_id'])
                        $participante['p'] = $participante['p'] + 3;

            foreach($resultados['semi'] as $r)
                foreach($apostas_finais['semi'] as $af)
                    if($af['time_id'] == $r['time_id'])
                        $participante['p'] = $participante['p'] + 4;

            foreach($resultados['tquarto'] as $r)
                foreach($apostas_finais['tquarto'] as $af)
                    if($af['time_id'] == $r['time_id'])
                        $participante['p'] = $participante['p'] + 5;

            foreach($resultados['final'] as $r)
                foreach($apostas_finais['final'] as $af)
                    if($af['time_id'] == $r['time_id'])
                        $participante['p'] = $participante['p'] + 6;

            //APOSTAS COLOCAÇÃO
            $resultados_colocacao = json_decode(ResultadosColocacaosController::getResults()[0]);
            $colocacaoF = json_decode($p['apostas_colocacao']);

            if($resultados_colocacao->primeiro->id == $colocacaoF->primeiro->id)
                $participante['p'] = $participante['p'] + 10;

            if($resultados_colocacao->segundo->id == $colocacaoF->segundo->id)
                $participante['p'] = $participante['p'] + 6;

            if($resultados_colocacao->terceiro->id == $colocacaoF->terceiro->id)
                $participante['p'] = $participante['p'] + 4;

            if($resultados_colocacao->quarto->id == $colocacaoF->quarto->id)
                $participante['p'] = $participante['p'] + 2;

            //APOSTAS PREMIAÇÃO
            $resultados_premiacao = json_decode(ResultadosPremiacaosController::getResults()[0]);
            $premiacaoF = json_decode($p['apostas_premiacao']);

            if($resultados_premiacao->artilheiro->id == $premiacaoF->artilheiro->id)
                $participante['p'] = $participante['p'] + 10;

            if($resultados_premiacao->ataque->id == $premiacaoF->ataque->id)
                $participante['p'] = $participante['p'] + 6;

            if($resultados_premiacao->defesa->id == $premiacaoF->defesa->id)
                $participante['p'] = $participante['p'] + 4;
                
            array_push($classificacao, $participante);
        }

        // $cSort = Helper::sortCollectionDesc($classificacao, ['p','pc','pv','pp','av']);
        $cSort = $classificacao;
        $response['records'] = $cSort;
        $response['result'] = $responseBd['result'];

        return Response::json($response, $result->code);
	}
//-------------------------------------------------
    public function show(Request $request, $id){
        $responseBd = Participantes::with('aposta.jogo.time1','aposta.jogo.time2','apostas_colocacao.primeiro','apostas_colocacao.segundo','apostas_colocacao.terceiro','apostas_colocacao.quarto','apostas_premiacao.artilheiro','apostas_premiacao.ataque','apostas_premiacao.defesa','apostas_finais.time')->find($id);

        // return($responseBd);

        $participante['nome'] = $responseBd['nome'];
        $participante['apostas'] = [];
        $participante['apostas_finais'] = [];

        //APOSTAS
        foreach($responseBd['aposta'] as $a)
        {
            $jogo = json_decode($a['jogo']);
            $aposta['id'] = $a['id'];
            $aposta['time1'] = $jogo->time1->sigla;
            $aposta['time2'] = $jogo->time2->sigla;
            $aposta['escore1'] = $a['escore1'];
            $aposta['escore2'] = $a['escore2'];
            $aposta['foto1'] = $jogo->time1->foto;
            $aposta['foto2'] = $jogo->time2->foto;
            $aposta['data'] = $jogo->data;
            
            /* 
            STATUS DA APOSTA

             0 - Jogo Pendente
             1 - 0 Pontos
             2 - 10 Pontos
             3 - 25 Pontos
            */
            
            $aposta['status'] = 0;

            if($jogo->status > 0)
            {
                $pontos = $this->getPontos($a['escore1'], $a['escore2'], $jogo->escore1, $jogo->escore2);
                
                if($pontos == 1)
                    $aposta['status'] = 3;   
                else if($pontos == 0)
                    $aposta['status'] = 1;   
            }

            array_push($participante['apostas'], $aposta);
        }

        //APOSTAS CLASSIFICACAO
        $colocacao = json_decode($responseBd['apostas_colocacao']);
        if($colocacao->primeiro)
            $nprimeiro = $colocacao->primeiro->nome;
        else
            $nprimeiro = $colocacao->primeiro;

        if($colocacao->segundo)
            $nsegundo = $colocacao->segundo->nome;
        else
            $nsegundo = $colocacao->segundo;

        if($colocacao->terceiro)
            $nterceiro = $colocacao->terceiro->nome;
        else
            $nterceiro = $colocacao->terceiro;

        if($colocacao->quarto)
            $nquarto = $colocacao->quarto->nome;
        else
            $nquarto = $colocacao->quarto;
            
        $participante['apostas_colocacao']['primeiro'] = $nprimeiro;
        $participante['apostas_colocacao']['segundo'] = $nsegundo;
        $participante['apostas_colocacao']['terceiro'] = $nterceiro;
        $participante['apostas_colocacao']['quarto'] = $nquarto;

        //APOSTAS PREMIACAO
        $colocacao = json_decode($responseBd['apostas_premiacao']);
        if($colocacao->artilheiro)
            $nartilheiro = $colocacao->artilheiro->nome;
        else
            $nartilheiro = $colocacao->artilheiro;

        if($colocacao->ataque)
            $nataque = $colocacao->ataque->nome;
        else
            $nataque = $colocacao->ataque;

        if($colocacao->defesa)
            $ndefesa = $colocacao->defesa->nome;
        else
            $ndefesa = $colocacao->defesa;

        $participante['apostas_premiacao']['artilheiro'] = $nartilheiro;
        $participante['apostas_premiacao']['ataque'] = $nataque;
        $participante['apostas_premiacao']['defesa'] = $ndefesa;

        //APOSTAS FINAIS
        $apostas_finais['oitavas'] = [];
        $apostas_finais['quartas'] = [];
        $apostas_finais['semi'] = [];
        $apostas_finais['final'] = [];
        $apostas_finais['tquarto'] = [];

        foreach($responseBd['apostas_finais'] as $apostaF)
        {
            $final = json_decode($apostaF);
            $apostaF_aux['id'] = $final->id;
            $apostaF_aux['time_id'] = $final->time_id;
            
            if($final->time != null)
                $apostaF_aux['time'] = $final->time->nome;
            else
            $apostaF_aux['time'] = $final->time;

            array_push($apostas_finais[$final->fase], $apostaF_aux);
        }
        
        $participante['apostas_finais'] = $apostas_finais;
        
        $response['records'] = $participante;

        $result = new Result();
        $result->internalMessage = "Apostas carregadas";
        $result->setCode(200);

        $response['result'] = $result;

        return Response::json($response, $result->code);
    }
    public function getPontos($aposta1,$aposta2,$jogo1,$jogo2)
    {
        if($aposta1>$aposta2 && $jogo1 > $jogo2)
            return 1;
        else if($aposta1<$aposta2 && $jogo1 < $jogo2)
            return 1;
        else if($aposta1==$aposta2 && $jogo1 == $jogo2)
            return 1;
        else
            return 0;
    }
//-------------------------------------------------
public function store(Request $request){
    $recurso = new Participantes();
    $newresource = $request->toarray();
    
    $rest = new Rest();
    $rest->model = 'App\Models\Participantes';
    $rest->input = $newresource;
    $rest->instance = $recurso;

    $response = $rest->insert();
    $result = $response['result'];

    $id = $response['records']['id'];
    $jogos = Jogos::all();

    foreach($jogos as $jogo)
    {
        $aposta  = new Apostas();

        $aposta->participante_id = $id;
        $aposta->jogo_id = $jogo->id;

        $aposta->save();
    }

    $apostas_colocacao = new ApostasColocacao();
    $apostas_colocacao->participante_id = $id;
    $apostas_colocacao->save();

    $apostas_premiacao = new ApostasPremiacao();
    $apostas_premiacao->participante_id = $id;
    $apostas_premiacao->save();

    $max = 8;
    for($i=1;$i<=($max*2);$i++)
    {
        $apostas_finais = new ApostasFinais();
        $apostas_finais->fase = 'oitavas';
        $apostas_finais->participante_id = $id;
        $apostas_finais->save();
    }

    $max = 4;
    for($i=1;$i<=($max*2);$i++)
    {
        $apostas_finais = new ApostasFinais();
        $apostas_finais->fase ='quartas';
        $apostas_finais->participante_id = $id;
        $apostas_finais->save();
    }

    $max = 2;
    for($i=1;$i<=($max*2);$i++)
    {
        $apostas_finais = new ApostasFinais();
        $apostas_finais->fase = 'semi';
        $apostas_finais->participante_id = $id;
        $apostas_finais->save();
    }

    $max = 1;
    for($i=1;$i<=($max*2);$i++)
    {
        $apostas_finais = new ApostasFinais();
        $apostas_finais->fase = 'final';
        $apostas_finais->participante_id = $id;
        $apostas_finais->save();
    }

    $max = 1;
    for($i=1;$i<=($max*2);$i++)
    {
        $apostas_finais = new ApostasFinais();
        $apostas_finais->fase = 'tquarto';
        $apostas_finais->participante_id = $id;
        $apostas_finais->save();
    }

    return Response::json($response, $result->code);
}
//-------------------------------------------------
public function update(Request $request, $id){ 
    try
    {
        $recurso = Participantes::findOrFail($id);
        $newresource = $request->toarray();
        
        $rest = new Rest();
        $rest->model = 'App\Models\Participantes';
        $rest->input = $newresource;
        $rest->instance = $recurso;
        
        $response = $rest->renew();
        $result = $response['result'];

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
public function destroy($id){
    $result = new Result();
    $response = [];

    try
    {
        $recurso = Participantes::findOrFail($id);
        $recurso->delete();
            
        $result->setCode(200);
        $result->internalMessage = 'Record deleted successfully';

        $response['result'] = $result;

        return Response::json($response, $response['result']->code);
    }

    catch(ModelNotFoundException $e)
    {
        $result->setCode(404);
        $result->internalMessage = $e->getMessage();

        $response['result'] = $result;


        return Response::json($response, $response['result']->code);
    }

    catch (Exception $e)
    {
        $result->setCode(500);
        $result->internalMessage = $e->getMessage();

        $response['result'] = $result;

        return Response::json($response, $response['result']->code);
    }
}
}