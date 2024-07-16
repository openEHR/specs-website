<?php

use App\Context;
use Slim\App;

return static function (App $app) {
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Add routing middleware
    $app->addRoutingMiddleware();

    // Add error handler middleware
    $appContext = $app->getContainer()->get(Context::class);
    $app->addErrorMiddleware(
        // displayErrorDetails: Should be set to false for the production environment
        displayErrorDetails: !$appContext->isProduction() || $appContext->debug,
        // logErrors: Should be set to false for the test environment
        logErrors: !$appContext->isTest(),
        // logErrorDetails: Display error details in error log;
        logErrorDetails: true
    );
};
