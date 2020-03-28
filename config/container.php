<?php

use Psr\Container\ContainerInterface;
use App\Configuration;
use App\Domain\ComponentService;
use Slim\App;
use Slim\Factory\AppFactory;
use App\View;

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

    View::class => function (ContainerInterface $container) {
        $settings = $container->get(Configuration::class);
        return new View($settings->templates, $settings->attributes, $settings->layout);
    },

    ComponentService::class => function (ContainerInterface $container) {
        return new ComponentService($container->get(Configuration::class));
    }

];
