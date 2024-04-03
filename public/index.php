<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');

require '../vendor/autoload.php'; 

use Slim\Factory\AppFactory;
use DI\Container;
use Dotenv\Dotenv;
 
 

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$container = new Container();
AppFactory::setContainer($container);

$app = AppFactory::create();


$basepath = (function () {
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    $uri = (string) parse_url('http://a' . $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
    if (stripos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
        return $_SERVER['SCRIPT_NAME'];
    }
    if ($scriptDir !== '/' && stripos($uri, $scriptDir) === 0) {
        return $scriptDir;
    }
    return '';
})();

$app->setBasePath($basepath);

 

// Configuração correta do RouteParser
$container->set('routeParser', function() use ($app) {
    return $app->getRouteCollector()->getRouteParser();
});
 

// Registre o serviço de renderização
(require __DIR__ . '/../app/helpers/render.php')($container);



// Configurações adicionais do Slim (Middleware, Rotas, Tratamento de Erros)
(require __DIR__ . '/../app/config/middleware.php')($app);
(require __DIR__ . '/../app/config/routes.php')($app);
(require __DIR__ . '/../app/config/errorHandling.php')($app);
require __DIR__ . '/../app/config/registerContainer.php';

 

// Configuração do container
$container->set('upload_directory', function () {
    // Caminho absoluto para a pasta de uploads
    return __DIR__ . '/../public/uploads';
});

// Registrar controladores no container
registerControllers($container, __DIR__ . '/../app/controllers', 'app\\controllers');

 


$app->run();
