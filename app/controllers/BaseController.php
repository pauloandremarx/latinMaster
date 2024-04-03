<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;

class BaseController
{
    protected $render; // Serviço de renderização

    public function __construct($render)
    {
        $this->render = $render;
    }

    // Método para gerar diretamente a URL para uma rota nomeada
    protected function path_for(Request $request, string $routeName, array $params = []): string
    {
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        return $routeParser->urlFor($routeName, $params);
    }
}
