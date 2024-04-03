<?php

// /app/config/errorHandling.php

use Slim\App;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
use Slim\Psr7\Response;
use Slim\Exception\HttpNotFoundException;

return function (App $app) {
    $whoops = new Run();
    $whoops->pushHandler(new PrettyPageHandler());
    $whoops->register();

    $errorMiddleware = $app->addErrorMiddleware(true, true, true);
    $errorMiddleware->setDefaultErrorHandler(function (
        $request,
        Throwable $exception,
        bool $displayErrorDetails,
        bool $logErrors,
        bool $logErrorDetails,
        $response = null
    ) use ($app, $whoops) {
        if ($exception instanceof HttpNotFoundException) {
            $response = new Response();
            $response->getBody()->write('404 Not Found');
            return $response->withStatus(404);
        } else {
            ob_start();
            $whoops->handleException($exception);
            $content = ob_get_clean();
            $response = $response ?? new Response();
            $response->getBody()->write($content);
            return $response->withStatus(500);
        }
    });
};
