<?php

use CodeIgniter\Router\RouteCollection;

//Rota do Frontend
$routes->get('/', 'Frontend\TaskInterfaceController::index');

//Rotas da API
$routes->group('api', function($routes)
{
    $routes->get('listar', 'TaskController::index');
    $routes->post('cadastrar', 'TaskController::create');
    $routes->put('editar/(:num)', 'TaskController::update/$1');
    $routes->delete('excluir/(:num)', 'TaskController::delete/$1');
});