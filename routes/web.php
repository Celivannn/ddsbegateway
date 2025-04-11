<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| Simply tell Lumen the URIs it should respond to and assign the
| controllers that will handle them.
|
*/

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('/', function () use ($router) {
        return $router->app->version();
    });

    // ✅ Routes protected by client credentials middleware
    $router->group(['middleware' => 'client.credentials'], function () use ($router) {

        // API GATEWAY ROUTES FOR SITE1 USERS
        $router->get('/users1', 'User1Controller@index');
        $router->get('/users1/{id}', 'User1Controller@show');
        $router->post('/users1', 'User1Controller@add');
        $router->put('/users1/{id}', 'User1Controller@update');
        $router->patch('/users1/{id}', 'User1Controller@update');
        $router->delete('/users1/{id}', 'User1Controller@delete');

        // API GATEWAY ROUTES FOR SITE2 USERS
        $router->get('/users2', 'User2Controller@index');
        $router->get('/users2/{id}', 'User2Controller@show');
        $router->post('/users2', 'User2Controller@add');
        $router->put('/users2/{id}', 'User2Controller@update');
        $router->patch('/users2/{id}', 'User2Controller@update');
        $router->delete('/users2/{id}', 'User2Controller@delete');
    });

    // ✅ Routes protected by authenticated user (via Passport)
    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->get('/users/me', 'UserController@me');
    });

});
