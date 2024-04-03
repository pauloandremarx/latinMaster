<?php

use DI\Container;

function registerControllers(Container $container, $controllersPath, $namespacePrefix)
{
    $controllerFiles = glob($controllersPath . '/*.php');

    foreach ($controllerFiles as $file) {
        $className = $namespacePrefix . '\\' . basename($file, '.php');

        $container->set($className, function() use ($container, $className) {
            $render = $container->get('render'); // Assume que 'render' está registrado corretamente
            // Agora também passamos $container para o construtor
            return new $className($render, $container);
        });
        
    }
}
