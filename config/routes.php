<?php

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Slim\App;
use App\Action;

return function (App $app) {
    $app->get('/releases/{component}/{release}[/[{page}]]', Action\SpecViewerAction::class . ':pages');
    $app->get('/releases/{component}/{release}/{im}/diagrams/{diagram}', Action\SpecViewerAction::class . ':diagrams');
    $app->get('/', Action\WorkingBaselineAction::class);
    $app->get('/manifest', Action\WorkingBaselineAction::class . ':manifest');
    $app->get('/latest_releases', Action\ReleasesAction::class);
    $app->get('/historical_releases', Action\HistoricalReleasesAction::class);
//    $app->redirect('/from', '/to', 301);
};
