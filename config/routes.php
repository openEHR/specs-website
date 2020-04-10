<?php

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Slim\App;
use App\Action;

return function (App $app) {
    $app->get('/releases/{component}[/[{release}[/[index[.html]]]]]', Action\SpecViewerAction::class . ':index');
    $app->get('/releases/{component}/{release}/UML/{asset:.+\.mdzip}', Action\SpecViewerAction::class . ':uml');
    $app->get('/releases/{component}/{release}/{asset:.+\.(?:png|svg|html|xml|drawio|docx|g)}', Action\SpecViewerAction::class . ':assets');
    $app->get('/releases/{component}/{release}/{spec}', Action\SpecViewerAction::class . ':specs');
    $app->get('/', Action\WorkingBaselineAction::class);
    $app->get('/manifest', Action\WorkingBaselineAction::class . ':manifest');
    $app->get('/latest_releases', Action\ReleasesAction::class);
    $app->get('/historical_releases', Action\ReleasesAction::class . ':historical');
//    $app->redirect('/from', '/to', 301);
};
