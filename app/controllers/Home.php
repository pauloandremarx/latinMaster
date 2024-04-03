<?php

namespace app\controllers;

use app\controllers\BaseController;
use app\database\builder\ReadQuery;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
 
use app\classes\Validate;
 

class Home extends BaseController

{
    private $title = 'Latin Master';

    protected $render;
    protected $container;
 
    private $validate;
    private $posts;
    private $sliders;

    // Injetar o serviço de renderização no construtor
    public function __construct($render, $container )
    {
        parent::__construct($render);
        $this->container = $container;
       // Armazena o container na propriedade
    }

    public function index(Request $request, Response $response, array $args): Response

    {
        // Exemplo de como usar uma busca simples, mantendo o código mais limpo
        // Nota: O trecho comentado foi removido para simplificação

        /*
        $search = $_GET['s'] ?? '';
        $users = ReadQuery::select('users.id, firstName, lastName')
                    ->from('users')
                    ->where('users.id', '>=', 1)
                    ->where('firstName', 'like', "%{$search}%")
                    ->order('users.id', 'desc')
                    ->paginate(10);
        */
        // Corrigido para usar $this->title corretamente (acesso à propriedade de instância)

         // Busca todos os posts da tabela 'post'

        $this->posts = ReadQuery::select('*') // Seleciona todos os campos
        ->from('posts') // Da tabela 'post'
        ->get()->rows;

        $this->sliders = ReadQuery::select('*') // Seleciona todos os campos
        ->from('slider') // Da tabela 'post'
        ->get();  
       
        $url = $this->path_for($request, 'home', ['param1' => 'valor1', 'param2' => 'valor2']); 

        $currentPath = $request->getUri()->getPath();
 

            // Retorna e renderiza a view 'home', passando o título e os posts como dados para a view
        return ($this->render)($response, 'home', [
            'title' => $this->title . ' - Home', 
            'posts' =>  $this->posts,
            'currentPath' => $currentPath,
            'sliders' => $this->sliders
            ]);
    
        
    }

    
}

