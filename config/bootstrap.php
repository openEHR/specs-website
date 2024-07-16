<?php

use App\Context;
use DI\ContainerBuilder;
use Slim\App;

require_once __DIR__ . '/../vendor/autoload.php';

// Determine the application context and install things necessary
$appContext = Context::fromEnv();
$appContext->install();

// Build DI Container instance
$containerBuilder = new ContainerBuilder();
if ($appContext->isProduction()) {
    $containerBuilder->enableCompilation($appContext->cacheDir);
}
$containerBuilder->addDefinitions([Context::class => $appContext]);
$containerBuilder->addDefinitions(__DIR__ . '/container.php');
$container = $containerBuilder->build();

// Create App instance
$app = $container->get(App::class);

// Register routes
(require __DIR__ . '/routes.php')($app);
if ($appContext->isProduction()) {
    $routeCacheFile = $appContext->cacheDir . '/Routes.php';
    $app->getRouteCollector()->setCacheFile($routeCacheFile);
}

// Register middleware
(require __DIR__ . '/middleware.php')($app);

return $app;