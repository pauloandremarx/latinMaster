<?php

namespace app\controllers;

use app\controllers\BaseController;
use app\database\builder\ReadQuery;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
 
use app\classes\Validate;
 

class Error extends BaseController

{
    private $title = 'Latin Master';

    protected $render;
    protected $container;
  
    // Injetar o serviço de renderização no construtor
    public function __construct($render, $container )
    {
        parent::__construct($render);
        $this->container = $container;
       // Armazena o container na propriedade
    }

    public function index(Request $request, Response $response, array $args): Response

    { 

        $currentPath = $request->getUri()->getPath(); 
            // Retorna e renderiza a view 'home', passando o título e os posts como dados para a view
        return ($this->render)($response, 'error/index', [
            'title' => $this->title . ' - Pagina não encontrada',  
            'currentPath' => $currentPath, 
            ]);
    
        
    }

  
}

