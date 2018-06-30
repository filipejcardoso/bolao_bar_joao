<?php

use Illuminate\Http\Request;

Route::get('quadro', ['uses' => 'ParticipantesController@quadro']);

Route::group(['prefix' =>'participantes'],function()
{
	Route::get('', ['uses' => 'ParticipantesController@index']);
	Route::get('{id}', ['uses' => 'ParticipantesController@show']);
	Route::post('', ['uses' => 'ParticipantesController@store']);
	Route::patch('{id}', ['uses' => 'ParticipantesController@update']);
	Route::delete('{id}', ['uses' => 'ParticipantesController@destroy']);
	
	Route::group(['prefix' =>'/{participantes}/apostas'],function()
	{
		Route::get('', ['uses' => 'ApostasController@index']);
		Route::patch('{id}', ['uses' => 'ApostasController@update']);
	});
	Route::group(['prefix' =>'/{participantes}/apostas_colocacaos'],function()
	{
		Route::patch('', ['uses' => 'ApostasColocacaosController@update']);
	});
	Route::group(['prefix' =>'/{participantes}/apostas_premiacaos'],function()
	{
		Route::patch('', ['uses' => 'ApostasPremiacaosController@update']);
	});
	Route::group(['prefix' =>'/{participantes}/apostas_finais'],function()
	{
		Route::get('', ['uses' => 'ApostasFinaisController@index']);
		Route::patch('{id}', ['uses' => 'ApostasFinaisController@update']);
	});
});
Route::group(['prefix' =>'/times'],function()
{
	Route::get('', ['uses' => 'TimesController@index']);
});
Route::group(['prefix' =>'/jogadores'],function()
{
	Route::get('', ['uses' => 'JogadoresController@index']);
});
Route::group(['prefix' =>'/jogos'],function()
{
	Route::get('', ['uses' => 'JogosController@index']);
	Route::patch('{id}', ['uses' => 'JogosController@update']);
});
Route::group(['prefix' =>'/resultados_finais'],function()
{
	Route::get('', ['uses' => 'ResultadosFinaisController@index']);
	Route::post('', ['uses' => 'ResultadosFinaisController@store']);
	Route::patch('{id}', ['uses' => 'ResultadosFinaisController@update']);
});


