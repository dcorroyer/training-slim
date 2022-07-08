<?php
declare(strict_types=1);

use App\Application\Actions\Animal\CreateAnimalAction;
use App\Application\Actions\Animal\DeleteAnimalAction;
use App\Application\Actions\Animal\GetAnimalAction;
use App\Application\Actions\Animal\ListAnimalsAction;
use App\Application\Actions\Animal\UpdateAnimalAction;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    $app->group('/animal', function (Group $group) {
        $group->get('s', ListAnimalsAction::class);
        $group->get('/{id}', GetAnimalAction::class);
        $group->post('', CreateAnimalAction::class);
        $group->put('/{id}', UpdateAnimalAction::class);
        $group->delete('/{id}', DeleteAnimalAction::class);
    });
};
