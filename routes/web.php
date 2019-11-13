<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index');

Route::get('/suggestions/create','SuggestionController@create');
Route::post('/suggestions','SuggestionController@store');
Route::get('/suggestions','SuggestionController@index');

Route::get('/suggestions/processar_sugestao/{suggestion}','SuggestionController@processar_sugestao');
Route::post('/suggestions/store_processar_sugestao/{suggestion}','SuggestionController@store_processar_sugestao');


Route::get('/suggestions/processar_aquisicao/{acquisition}','SuggestionController@processar_aquisicao');
Route::post('/suggestions/store_processar_aquisicao/{acquisition}','SuggestionController@store_processar_aquisicao');

//Rota para mostrar as sugestões em processo de aquisição
Route::get('/suggestions/lista_aquisicao/','SuggestionController@lista_aquisicao');
//Rota para mostrar a lista com o status das sugestões
Route::get('/suggestions/consulta/','SuggestionController@consulta');


