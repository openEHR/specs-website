<?php

use Psr\Container\ContainerInterface;
use App\Configuration;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;

return [
    Configuration::class => function () {
        return new Configuration(require __DIR__ . '/settings.php');
    },

    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);
        $app = AppFactory::create();

        // Optional: Set the base path to run the app in a sub-directory
        // The public directory must not be part of the base path
        //$app->setBasePath('/slim4-tutorial');

        return $app;
    },

    PhpRenderer::class => function () {
        $attributes = [
            'title' => '',
            'page' => '',
        ];
        return new PhpRenderer(__DIR__ . '/../templates/', $attributes, 'layout.phtml');
    },

];