<?php

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Slim\App;
use App\Action;

return function (App $app) {
    $app->get('/releases/{component}/{release}/{page}', Action\SpecViewerAction::class);
    $app->get('/', Action\WorkingBaselineAction::class);
    $app->get('/latest_releases', Action\ReleasesAction::class);
    $app->get('/historical_releases', Action\HistoricalReleasesAction::class);
//    $app->redirect('/from', '/to', 301);
};
