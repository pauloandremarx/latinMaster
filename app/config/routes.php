<?php 


use Slim\App;

// Caminho absoluto ou relativo para o arquivo da classe Web
require_once __DIR__ . '/../routes/Web.php';

return function (App $app) {
    \App\Routes\Web::setupRoutes($app);
};
