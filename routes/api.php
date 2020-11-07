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
    $router->post('/check', 'ProductController@check');
});
$router->group(['prefix' => 'bookmark'], function () use ($router) {

    $router->post('/', 'BookmarktController@store');
    $router->get('/{id}', 'BookmarktController@show');
    $router->put('/{id}', 'BookmarktController@update');
    $router->delete('/{id}', 'BookmarktController@destroy');
});

$router->group(['prefix' => 'credit'], function () use ($router) {

    $router->post('/', 'UserController@store');
    $router->get('/{id}', 'UserController@show');
    $router->put('/{id}', 'UserController@update');
    $router->delete('/{id}', 'UserController@destroy');
});
