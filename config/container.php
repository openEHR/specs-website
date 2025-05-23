<?php

use App\Domain\Service\ComponentService;
use App\Domain\Service\SearchService;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use App\Configuration;
use App\View;
use App\View\NavBar;
use App\Context;
use App\Environment;
use Slim\Http\Factory\DecoratedResponseFactory;
use Slim\Http\Factory\DecoratedServerRequestFactory;
use Slim\Http\Factory\DecoratedUriFactory;

use function DI\autowire;

return [
    // Notice: The following are contained implicitly by default:
    //  - Context::class
    //  - App::class

    Environment::class => static function (ContainerInterface $container): Environment {
        /** @var Context $appContext */
        $appContext = $container->get(Context::class);
        return $appContext->environment;
    },

    Configuration::class => static function (): Configuration {
        return new Configuration(require __DIR__ . '/settings.php');
    },

    App::class => static function (ContainerInterface $container): App {
        AppFactory::setContainer($container);
        return AppFactory::create();
    },

    ComponentService::class => autowire(),
    SearchService::class => autowire(),

    // HTTP interfaces
    Psr17Factory::class => autowire(),
    DecoratedResponseFactory::class => autowire(),
    DecoratedServerRequestFactory::class => autowire(),
    DecoratedUriFactory::class => autowire(),
    ResponseFactoryInterface::class => static function (ContainerInterface $container): ResponseFactoryInterface {
        $psr17Factory = $container->get(Psr17Factory::class);
        return new DecoratedResponseFactory($psr17Factory, $psr17Factory);
    },
    ServerRequestFactoryInterface::class => static function (ContainerInterface $container): ServerRequestFactoryInterface {
        $psr17Factory = $container->get(Psr17Factory::class);
        return new DecoratedServerRequestFactory($psr17Factory);
    },
    StreamFactoryInterface::class => static function (ContainerInterface $container): DecoratedUriFactory {
        $psr17Factory = $container->get(Psr17Factory::class);
        return new DecoratedUriFactory($psr17Factory);
    },
    UploadedFileFactoryInterface::class => DI\get(Psr17Factory::class),
    UriFactoryInterface::class => DI\get(Psr17Factory::class),

    View::class => static function (ContainerInterface $container): View {
        /** @var Context $appContext */
        $appContext = $container->get(Context::class);
        $settings = $container->get(Configuration::class)->view;
        $navbar = $container->get(NavBar::class);
        return new View($appContext->dir . '/templates', $settings, $navbar);
    },

    NavBar::class => static function (ContainerInterface $container): NavBar {
        $settings = $container->get(Configuration::class)->navbar;
        return new NavBar($settings);
    },

];
