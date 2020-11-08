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
    $router->post('/login', 'UserController@login');
    $router->get('/{id}', 'UserController@show');
    $router->put('/{id}', 'UserController@update');
    $router->delete('/{id}', 'UserController@destroy');
});

$router->group(['prefix' => '/user/{user_id}/product'], function () use ($router) {

    $router->get('/', 'ProductController@index');
    $router->post('/{product_id}', 'ProductController@store');
    $router->get('/{product_id}', 'ProductController@show');
    $router->put('/{product_id}', 'ProductController@update');
    $router->delete('/{product_id}', 'ProductController@destroy');
    $router->post('/{product_id}/pay', 'ProductController@pay');
});

$router->group(['prefix' => '/user/{user_id}/bookmark'], function () use ($router) {

     $router->post('/', 'BookmarkController@store');
     $router->get('/{bookmark_id}', 'BookmarkController@show');
     $router->put('/{bookmark_id}', 'BookmarkController@update');
     $router->delete('/{bookmark_id}', 'BookmarkController@destroy');
});

 $router->group(['prefix' => '/user/{user_id}/credit'], function () use ($router) {
     $router->post('/', 'CreditCardController@store');
     $router->get('/{credit_id}', 'CreditCardController@show');
     $router->put('/{credit_id}', 'CreditCardController@update');
     $router->delete('/{credit_id}', 'CreditCardController@destroy');
     $router->post('/check', 'CreditCardController@check');
});
