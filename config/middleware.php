<?php

use App\Configuration;
use Slim\App;

return static function (App $app) {
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Add routing middleware
    $app->addRoutingMiddleware();

    // Add error handler middleware
    $settings = $app->getContainer()->get(Configuration::class)->error_handler_middleware;
    $displayErrorDetails = (bool)$settings->display_error_details;
    $logErrors = (bool)$settings->log_errors;
    $logErrorDetails = (bool)$settings->log_error_details;

    $app->addErrorMiddleware($displayErrorDetails, $logErrors, $logErrorDetails);
};
