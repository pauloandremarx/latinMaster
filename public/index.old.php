<?php

use Slim\Factory\AppFactory;
 
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
 
use Slim\Middleware\MethodOverrideMiddleware;

require __DIR__ . '/../vendor/autoload.php';

// Inicia a sessão
session_start();

// Define o fuso horário para São Paulo
date_default_timezone_set('America/Sao_Paulo');

// Cria uma instância do aplicativo Slim
$app = AppFactory::create();

// Configura o base path dinamicamente usando a função fornecida
$app->setBasePath((function () {
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    $uri = (string) parse_url('http://a' . ($_SERVER['REQUEST_URI'] ?? ''), PHP_URL_PATH);
    if (stripos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
        return $_SERVER['SCRIPT_NAME']; // Retorna o script name se o URI começar com o mesmo
    }
    if ($scriptDir !== '/' && stripos($uri, $scriptDir) === 0) {
        return $scriptDir; // Retorna o diretório do script se o URI começar com o mesmo
    }
    return ''; // Retorna uma string vazia como fallback
})());

// Adiciona o middleware MethodOverrideMiddleware
 
$app->add(MethodOverrideMiddleware::class);

$app->addErrorMiddleware(true, true, true);



// Inclui as rotas do arquivo web.php
$routes = require __DIR__ . '/../app/routes/web.php';
$routes($app);

// Configuração do Whoops para tratamento de erros
$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);

// Registra o Whoops como middleware de erro
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler($whoops);

// Executa o aplicativo
$app->run();







