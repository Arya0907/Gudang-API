<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->post('/login', 'UserController@login'); // Login
$router->post('/register', 'UserController@register'); // Register


$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/logout', 'UserController@logout'); // Logout
    $router->get('/me', 'UserController@me'); // Get user
    $router->get('/delete-profile', 'UserController@deleteProfile'); // Get user
    $router->post('/update-profile', 'UserController@updateProfile'); // Update user


    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get('/', 'UserController@index'); // Get semua user
        $router->get('{id}', 'UserController@show'); // Get user by ID
        $router->post('/', 'UserController@store'); // Create user
        $router->patch('{id}', 'UserController@update'); // Update user
        $router->delete('{id}', 'UserController@destroy'); // Delete user
});

$router->group(['prefix' => 'packages'], function () use ($router) {
    $router->get('/', 'PackageController@index'); // Get semua paket
    $router->get('{id}', 'PackageController@show'); // Get paket by ID
    $router->post('/', 'PackageController@store'); // Create paket
    $router->patch('{id}', 'PackageController@update'); // Update paket
    $router->delete('{id}', 'PackageController@destroy'); // Soft Delete
    $router->post('{id}/restore', 'PackageController@restore'); // Restore paket
    $router->delete('{id}/force-delete', 'PackageController@forceDelete'); // Hapus permanen
});

$router->group(['prefix' => 'deliveries'], function () use ($router) {
    $router->get('/', 'DeliveryController@index'); // Get semua pengiriman
    $router->get('{id}', 'DeliveryController@show'); // Get pengiriman by ID
    $router->post('/', 'DeliveryController@store'); // Create pengiriman
    $router->patch('{id}', 'DeliveryController@update'); // Update pengiriman
    $router->delete('{id}', 'DeliveryController@destroy'); // Soft Delete
    $router->post('{id}/restore', 'DeliveryController@restore'); // Restore pengiriman
    $router->delete('{id}/force-delete', 'DeliveryController@forceDelete'); // Hapus permanen
});
});

