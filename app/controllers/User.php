<?php

namespace app\controllers;

use app\controllers\BaseController;
use app\database\builder\ReadQuery;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use app\classes\Validate;
use app\classes\Flash;

use app\database\models\User as ModelsUser;

class User extends BaseController
{
    private $validate;
    protected $user;

    public function __construct($render, $container)
    {
        parent::__construct($render);
        $this->container = $container;
        $this->validate = new Validate;
        $this->user = new ModelsUser;
    }

    private $title = 'Latin Master';

    protected $render;
    protected $container;

    // Injetar o serviço de renderização no construtor


    public function create($request, $response, $args)
    {

        $user_get = $this->user->findBy('id', '*');

        $currentPath = $request->getUri()->getPath();
        $method = $request->getMethod();

        if ($method == 'GET') {
            if ($user_get) {
                return redirect($response, $this->path_for($request, 'login'));
            }else{
                return ($this->render)($response, 'register', [
                    'title' => $this->title . ' - Criar usuário',
                    'currentPath' => $currentPath,
    
                ]);
            }  
        } else {

            $name = strip_tags($_POST['name']);
 
            $email = strip_tags($_POST['email']);
            $password = strip_tags($_POST['password']);

            $this->validate->required(['name', 'email', 'password'])
                ->exist($this->user, 'email', $email)
                ->email('email', $email);
            $errors = $this->validate->getErrors();

            if ($errors) {
                return redirect($response, $this->path_for($request, 'user.create'));
            }

            $created = $this->user->create(['name' => $name, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

            if ($created) {
                Flash::set('message', 'Cadastrado com sucesso');

                return redirect($response, $this->path_for($request, 'login'));
            }

            Flash::set('message', 'Ocorreu um erro ao cadastrar o user');
            return redirect($response, $this->path_for($request, 'user.create')); 
        }
    }
}
