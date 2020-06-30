<?php

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Slim\App;
use App\Action;

return function (App $app) {
    $app->redirect('/releases/AA_GLOBAL/latest/[index.html]', '/classes', 301);
    $app->get('/releases/{component}[/[{release}[/[index[.html]]]]]', Action\SpecViewerAction::class . ':index');
    $app->get('/releases/{component}/{release}/UML/{asset:.+\.mdzip}', Action\SpecViewerAction::class . ':uml');
    $app->get('/releases/{component:ITS-XML|ITS-JSON}/{release}/components[/[{asset:.+}]]', Action\ITSDirViewerAction::class);
    $app->get('/releases/{component}/{release}/{asset:.+\.(?:png|svg|html|xml|drawio|docx|g|jj)}', Action\SpecViewerAction::class . ':assets');
    $app->get('/releases/{component}/{release}/{spec}', Action\SpecViewerAction::class . ':specs');
    $app->get('/', Action\WorkingBaselineAction::class);
    $app->get('/classes[/{class}]', Action\WorkingBaselineAction::class . ':classes');
    $app->get('/manifest', Action\WorkingBaselineAction::class . ':manifest');
    $app->get('/latest_releases', Action\ReleasesAction::class);
    $app->get('/historical_releases', Action\ReleasesAction::class . ':historical');
    // redirects
    $app->redirect('/wiki/display/spec/Specifications+Home', 'https://openehr.atlassian.net/wiki/spaces/spec/overview', 301);
    $app->redirect('/Services+Landscape+for+e-Health', 'https://openehr.atlassian.net/wiki/spaces/spec/pages/357957633/Services+Landscape+for+e-Health', 301);
};
