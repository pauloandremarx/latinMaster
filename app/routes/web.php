<?php

namespace app\routes;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use app\middlewares\AuthMiddleware; 
use app\controllers\Home;
use app\controllers\Blog;
use app\controllers\Admin;
use app\controllers\Post;
use app\controllers\Slider;
use app\controllers\Login;
use app\controllers\User;
use app\controllers\Error;
use app\controllers\EmailController;

class Web
{
    public static function setupRoutes(App $app): void
    {
        $authMiddleware = new AuthMiddleware();


        // Rota para envio de email
        $app->post('/send-email',  EmailController::class . ':sendEmail')->setName('send.email');
        $app->post('/send-email-forgot-password',  EmailController::class . ':sendForgotPasswordEmail')->setName('send.forgot');
        
        // Home route
        $app->get('/', Home::class . ':index')->setName('home');
        $app->get('/home', Home::class . ':index')->setName('post.home');

        // Blog routes
        $app->group('/blog', function (RouteCollectorProxy $group) {
            $group->get('', Blog::class . ':index')->setName('blog');
            $group->get('/{id}', Blog::class . ':single')->setName('blog.single');
            $group->map(['GET', 'POST'], '/', Blog::class . ':buscar')->setName('blog.buscar');
        });

        // Admin routes
        $app->group('/admin', function (RouteCollectorProxy $group) use ($authMiddleware) {
            $group->get('', Admin::class . ':index')->setName('admin')->add([$authMiddleware, 'redirectToLogin']);
          
        });

        // Post routes
         $app->group('/postagem', function (RouteCollectorProxy $group) use ($authMiddleware) {
            $group->get('', Post::class . ':index')->setName('post');
            $group->map(['GET', 'POST'], '/criar', Post::class . ':create')->setName('post.create');
            $group->map(['GET', 'POST'], '/edit/{id}', Post::class . ':update')->setName('post.update');
            $group->post('/deletar', Post::class . ':delete')->setName('post.delete');
        })->add([$authMiddleware, 'redirectToLogin']);

        $app->group('/slider', function (RouteCollectorProxy $group) use ($authMiddleware) {
            $group->get('', Slider::class . ':index')->setName('slider');
            $group->map(['GET', 'POST'], '/criar', Slider::class . ':create')->setName('slider.create');
            $group->map(['GET', 'POST'], '/edit/{id}', Slider::class . ':update')->setName('slider.update');
            $group->post('/deletar', Slider::class . ':delete')->setName('slider.delete');
        })->add([$authMiddleware, 'redirectToLogin']);

        $app->group('/user', function (RouteCollectorProxy $group) {
             /*  $group->get('', User::class . ':index')->setName('user');*/
         $group->map(['GET', 'POST'], '/criar', User::class . ':create')->setName('user.create');
            /*$group->map(['GET', 'POST'], '/edit/{id}', User::class . ':update')->setName('user.update');*/
            /*$group->post('/deletar', User::class . ':delete')->setName('user.delete');*/
        });

     
        $app->get('/login', Login::class . ':index')->setName('login');
        $app->post('/login', Login::class . ':store')->setName('login.store');
        $app->get('/logout', Login::class . ':destroy')->setName('login.destroy');


        $app->any('/{routes:.+}', Error::class . ':index')->setName('error');
    }
}
