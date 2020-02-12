<?php
namespace CrudJsonApi\Test\App\Config;

use Cake\Routing\Route\InflectedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::scope('/', function (RouteBuilder $routes) {
    $routes->setRouteClass(InflectedRoute::class);
    $routes->setExtensions(['json']);

    $routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'InflectedRoute']);
    $routes->connect('/:controller/:action/*', [], ['routeClass' => 'InflectedRoute']);

    $routes->resources('Countries', function (RouteBuilder $routes) {
        $routes->connect(
            '/relationships/:type',
            [
                'controller' => 'Currencies',
                '_method' => 'GET',
                'action' => 'view',
                'from' => 'Countries',
            ]
        );

        return $routes;
    });
    $routes->resources('Currencies');
    $routes->resources('Cultures');
});