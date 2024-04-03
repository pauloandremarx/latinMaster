<?php

namespace app\controllers;

use app\controllers\BaseController;
use app\database\builder\ReadQuery;
use app\database\builder\InsertQuery;
use app\database\builder\DeleteQuery;
use app\database\builder\UpdateQuery;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use app\classes\Validate;
use app\database\models\Post;

class Blog extends BaseController

{
    private $title = 'IPq - Instituto de Psiquiatria';

    protected $render;
    private $validate;
    private $post;

    // Injetar o serviço de renderização no construtor
    public function __construct($render)
    {
        parent::__construct($render);
        $this->validate = new Validate;
        $this->post = new Post;
    }


    public function index(Request $request, Response $response, array $args): Response

    {
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
        $posts = ReadQuery::select('*') // Seleciona todos os campos
        ->from('posts') // Da tabela 'post'
        ->get(); 

        $currentPath = $request->getUri()->getPath();

        $url = $this->path_for($request, 'home', ['param1' => 'valor1', 'param2' => 'valor2']); 

            // Retorna e renderiza a view 'home', passando o título e os posts como dados para a view
        return ($this->render)($response, 'home', [
            'title' => $this->title . ' - Home', 
            'posts' => $posts,
            'currentPath' => $currentPath,
            ]);
    
        
    }

    public function single(Request $request, Response $response, array $args): Response

    { 
        // Busca todos os posts da tabela 'post'
        $id = intval(strip_tags($args['id']));
         
        $currentPath = $request->getUri()->getPath();

        $post = ReadQuery::select('*')->from('posts')->where('id', '=', $id)->first()->register;

        $posts = ReadQuery::select('*') // Seleciona todos os campos
        ->from('posts') // Da tabela 'post'
        ->get()->rows;

        if($post){
            return ($this->render)($response, 'blog/single', [
                'title' => $this->title . ' - Home', 
                'post' => $post,
                'posts' => $posts,
                'currentPath' => $currentPath,
                ]);
        }
        else{
            return redirect($response, $this->path_for($request, 'error', ['routes' => 'url-nao-encontrada']));
        }
             
        
    }


     
}

