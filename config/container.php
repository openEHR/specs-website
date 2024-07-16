<?php

use App\Domain\Service\ComponentService;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use App\Configuration;
use App\View;
use App\View\NavBar;
use App\Context;
use App\Environment;

return [
    // Notice: The following are contained implicitly by default:
    //  - Context::class
    //  - App::class

    Environment::class => static function (ContainerInterface $container): Environment {
        /** @var Context $appContext */
        $appContext = $container->get(Context::class);
        return $appContext->environment;
    },

    Configuration::class => static function () {
        return new Configuration(require __DIR__ . '/settings.php');
    },

    App::class => static function (ContainerInterface $container) {
        AppFactory::setContainer($container);
        return AppFactory::create();
    },

    ComponentService::class => static function (ContainerInterface $container) {
        /** @var Context $appContext */
        $appContext = $container->get(Context::class);
        return new ComponentService($appContext);
    },

    View::class => static function (ContainerInterface $container) {
        /** @var Context $appContext */
        $appContext = $container->get(Context::class);
        $settings = $container->get(Configuration::class)->view;
        $navbar = $container->get(NavBar::class);
        return new View($appContext->dir . '/templates', $settings, $navbar);
    },

    NavBar::class => static function (ContainerInterface $container) {
        $settings = $container->get(Configuration::class)->navbar;
        return new NavBar($settings);
    },

];
