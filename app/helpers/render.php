<?php

use DI\Container;
use League\Plates\Engine;
use Slim\Routing\RouteParser;

return function (Container $container) {
    $container->set('render', function () use ($container) {

        $path = dirname(__FILE__, 2);
        $templates = new Engine($path . DIRECTORY_SEPARATOR . 'views');
        // Aqui, garantimos o uso correto do 'routeParser' registrado no container
        $routeParser = $container->get('routeParser');


        // Configuração das funções personalizadas do Plates
        $templates->registerFunction('getFlash', function (string $key) {
            // Supondo que você tenha uma função getFlash implementada
            return getFlash($key);
        });

          // Configuração das funções personalizadas do Plates
          $templates->registerFunction('getFlashModal', function (string $key) {
            // Supondo que você tenha uma função getFlash implementada
            return getFlashModal($key);
        });

        $templates->registerFunction('old', function (string $key) {
            // Supondo que você tenha uma função old implementada
            return old($key);
        });

        $templates->registerFunction('safeInsert', function ($name, $data = []) use ($templates) {
            try {
                return $templates->render($name, $data);
            } catch (\LogicException $e) {
                return ''; // Retorna uma string vazia se o template não for encontrado
            }
        });

        $templates->registerFunction('baseUrl', function () {
            // Assume que BASE_PATH já está definido
            return BASE_PATH;
        });

        $templates->registerFunction('base_path', function () {
            // Assume que BASE_PATH já está definido
            return BASE_PATH;
        });

        $templates->registerFunction('urlFor', function ($name, $params = []) use ($routeParser) {
            return $routeParser->urlFor($name, $params);
        });

        $templates->registerFunction('path_for', function ($name, $params = []) use ($routeParser) {
            return $routeParser->urlFor($name, $params);
        });

        $templates->registerFunction('formatDateToBR', function ($date, $format = 'd/m/Y') {
            // Certifique-se de que a função formatDateToBR esteja acessível aqui, seja por inclusão ou definição
            return formatDateToBR($date, $format);
        });

     

        // Dentro do arquivo render.php, quando você configura o serviço 'render':
        return function ($response, $view, array $data = []) use ($templates, $container) {
      
        
            foreach ($data as $key => $value) {
                $templates->addData([$key => $value]);
            }
        
            $output = $templates->render($view, $data);
            $response->getBody()->write($output);
            return $response;
        };
        
    });
};
