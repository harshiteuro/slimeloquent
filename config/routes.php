<?php
use DI\ContainerBuilder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

use \App\Action\HomeAction;
use \App\Action\UserCreateAction;

use Illuminate\Database\Connection;


return function (App $app) {
    // $app->get('/',function (Request $request,Response $response){
    //     $response->getBody()->write('Hello, World!');
    //     return $response;
    // });
    // $app->get('/', \App\Action\HomeAction::class)->setName('home');
    $app->get('/use', function(Request $request,Response $response){
        $obj=new HomeAction();
        $data=$obj->index();
        $response->getBody()->write(json_encode($data));
        return $response;
    });
    $app->get('/all', function(Request $request,Response $response){
        $containerBuilder = new ContainerBuilder();

        // Set up settings
        $containerBuilder->addDefinitions(__DIR__ . '/container.php');

    // Build PHP-DI Container instance
        $container = $containerBuilder->build();

        $conn = $container->get(Conn::class);
        $obj=new UserCreateAction($conn);
        $data=$obj->all();
        $response->getBody()->write(json_encode($data));
        return $response;
    });


    // $app->get('/users', \App\Domain\Repository\UserRepository::class::index);
};