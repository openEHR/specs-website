<?php

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use App\Configuration;
use App\Domain\Service\ComponentService;
use App\View;
use App\View\NavBar;

return [
    Configuration::class => function () {
        return new Configuration(require __DIR__ . '/settings.php');
    },

    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);
        $app = AppFactory::create();
        return $app;
    },

    View::class => function (ContainerInterface $container) {
        $settings = $container->get(Configuration::class)->view;
        $navbar = $container->get(NavBar::class);
        return new View($settings, $navbar);
    },

    NavBar::class => function (ContainerInterface $container) {
        $settings = $container->get(Configuration::class)->navbar;
        return new NavBar($settings);
    },

];
