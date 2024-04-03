<?php

// /app/config/middleware.php

use Slim\App;
use Slim\Middleware\MethodOverrideMiddleware;

return function (App $app) {
    // Middleware de detecção de BasePath atualizado para correção
    $methodOverrideMiddleware = new MethodOverrideMiddleware();
    $app->add($methodOverrideMiddleware);
};
