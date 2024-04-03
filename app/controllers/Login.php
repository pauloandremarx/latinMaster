<?php

namespace app\controllers;

use app\controllers\BaseController;
use app\classes\Flash;
use app\classes\Login as UserLogin;
use app\classes\Validate;

use app\database\builder\ReadQuery;

class Login extends BaseController
{
    private $title = 'Latin Master';

    protected $render;
    protected $container;
 
    private $validate;
 
    private $user;

    private $login;

    public function __construct($render, $container)
    {
        parent::__construct($render);
        $this->container = $container;
        $this->login = new UserLogin;
    }

    public function index($request, $response)
    {
        // Verifica se o usuário está logado
        if (isLogged()) {
            // Redireciona para a rota de administração
            // Supondo que 'path_for' é um método para obter a URL da rota 'admin'
       
            return redirect($response, $this->path_for($request, 'admin'));
        }
    
        $this->user = ReadQuery::select('*') // Seleciona todos os campos
            ->from('users') // Da tabela 'users'
            ->first();
    
        $currentPath = $request->getUri()->getPath();
    
        return ($this->render)($response, 'login', [
            'title' => $this->title . 'Login',
            'currentPath' => $currentPath,
            'user' => $this->user->register
        ]);
    }

    public function store($request, $response)
    {
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);

        $validate = new Validate;
        $validate->required(['email', 'password'])->email('email', $email);
        $errors = $validate->getErrors();
        $url = $this->path_for($request, 'login');

 
        if ($errors) {
            return redirect($response, $url);
             
        }

        $logged = $this->login->login($email, $password);

      

        if ($logged) { 
            return redirect($response, $this->path_for($request, 'admin'));
        }

        
        Flash::set('message', 'Ocorreu um erro ao logar, tente novamente em alguns segundos', 'danger');

      

        return redirect($response, $url);
    }

    public function destroy($request, $response)
    {
        $this->login->logout();

        return redirect($response, $this->path_for($request, 'login'));
    }
}
