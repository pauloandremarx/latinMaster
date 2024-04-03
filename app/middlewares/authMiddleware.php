<?php

namespace app\middlewares;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as SlimResponse;

class AuthMiddleware
{
    /**
     * Método invocado pelo Slim 4 para executar o middleware que redireciona para a base.
     */
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        if (!isset($_SESSION['is_logged_in'])) {
            $response = new SlimResponse();
            return redirect($response, BASE_PATH);
        }

        return $handler->handle($request);
    }

    /**
     * Método para executar o middleware que redireciona para o login.
     */
    public function redirectToLogin(Request $request, RequestHandler $handler): Response
    {
        if (!isset($_SESSION['is_logged_in'])) {
            $response = new SlimResponse();
            return redirect($response, BASE_PATH.'login');
        }

        return $handler->handle($request);
    }

  
}
