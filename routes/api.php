<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$router->group(['prefix' => 'user'], function () use ($router) {

    $router->get('/', 'UserController@index');
    $router->post('/', 'UserController@store');
    $router->get('/{id}', 'UserController@show');
    $router->put('/{id}', 'UserController@update');
    $router->delete('/{id}', 'UserController@destroy');
});

$router->group(['prefix' => 'product'], function () use ($router) {

    $router->get('/', 'ProductController@index');
    $router->post('/', 'ProductController@store');
    $router->get('/{id}', 'ProductController@show');
    $router->put('/{id}', 'ProductController@update');
    $router->delete('/{id}', 'ProductController@destroy');
    $router->post('/pay', 'ProductController@pay');
});
$router->group(['prefix' => 'bookmark'], function () use ($router) {

    $router->post('/', 'BookmarkController@store');
    $router->get('/{id}', 'BookmarkController@show');
    $router->put('/{id}', 'BookmarkController@update'); // DUVIDA: necessário?
    $router->delete('/{id}', 'BookmarkController@destroy');
});

$router->group(['prefix' => 'credit'], function () use ($router) {
    $router->post('/', 'CreditCardController@store');
    $router->get('/{id}', 'CreditCardController@show');
    $router->put('/{id}', 'CreditCardController@update');
    $router->delete('/{id}', 'CreditCardController@destroy');
    $router->post('/check', 'CreditCardController@check');
});
