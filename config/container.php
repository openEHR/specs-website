<?php

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use App\Configuration;
use App\Domain\Service\ComponentService;
use App\View;
use App\View\NavBar;

return [
    Configuration::class => static function () {
        return new Configuration(require __DIR__ . '/settings.php');
    },

    App::class => static function (ContainerInterface $container) {
        AppFactory::setContainer($container);
        return AppFactory::create();
    },

    View::class => static function (ContainerInterface $container) {
        $settings = $container->get(Configuration::class)->view;
        $navbar = $container->get(NavBar::class);
        return new View($settings, $navbar);
    },

    NavBar::class => static function (ContainerInterface $container) {
        $settings = $container->get(Configuration::class)->navbar;
        return new NavBar($settings);
    },

];
