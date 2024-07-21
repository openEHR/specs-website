<?php

use App\Domain\Data\Release;
use Slim\App;
use App\Action;

return static function (App $app) {
    $app->redirect('/releases/AA_GLOBAL/latest[/[index.html]]', '/classes', 301);
    $app->get('/releases/{release:(?:0.9|0.95|1.0|1.0.1|1.0.2)}', Action\HistoricalReleasesAction::class . ':index');
    $app->get('/releases/{release:(?:0.9|0.95|1.0|1.0.1|1.0.2)}/{asset:.+}', Action\HistoricalReleasesAction::class . ':assets');
    $app->get('/releases/UML/' . Release::DEVELOPMENT . '/{asset:.*}', Action\UMLViewerAction::class . ':assets');
    $app->get('/releases/{component:ITS-XML|ITS-JSON|ITS-BMM}/{release}/components[/[{asset:.+}]]', Action\ITSAction::class . ':dir_viewer');
    $app->get('/releases/{component}/{alias:open_issues|roadmap|history|crs}', Action\RedirectAction::class . ':jira');
    $app->get('/releases/{component}/{release}/{alias:issues|changes}', Action\RedirectAction::class . ':jira');
    $app->get('/releases/{component:(?:ITS-REST)}/{release}/{asset:index\.html}', Action\SpecViewerAction::class . ':assets');
    $app->get('/releases/{component}[/[{release}[{idx:(?:/(?:docs/?)?(?:index(?:\.html)?)?)}]]]', Action\SpecViewerAction::class . ':index');
    $app->get('/releases/{component}/{release}/{asset:.+\.(?:png|svg|html|xml|xsd|yaml|yml|drawio|docx|g4|g|jj|json|txt|robot|mdzip)}', Action\SpecViewerAction::class . ':assets');
    $app->get('/fhir/{asset}', Action\FHIRViewerAction::class . ':assets');
    $app->get('/releases/{component}/{release}/{spec}', Action\SpecViewerAction::class . ':specs');
    $app->get('/[start[/]]', Action\StartAction::class);
    $app->get('/release_baseline[/]', Action\ReleaseBaselineAction::class);
    $app->get('/development_baseline[/]', Action\DevelopmentBaselineAction::class);
    $app->get('/classes[/{class}]', Action\DevelopmentBaselineAction::class . ':classes');
    $app->get('/manifest', Action\DevelopmentBaselineAction::class . ':manifest');
    $app->get('/search', Action\SearchAction::class);
    $app->get('/releases[/]', Action\ReleasesAction::class);
    $app->get('/components[/]', Action\ComponentsAction::class);
    $app->get('/its[/]', Action\ITSAction::class);
    // hooks
    $app->post('/hook/populate_releases', Action\HookAction::class . ':populate_releases');
    $app->post('/scripts/spec_populate_releases[.php]', Action\HookAction::class . ':populate_releases');
    // redirects
    $app->get('/components/{asset:.+}', Action\RedirectAction::class . ':components');
    $app->get('/tickets/{issue:.+}', Action\RedirectAction::class . ':tickets');
    $app->get('/wiki/{wiki:.+}', Action\RedirectAction::class . ':wiki');
    $app->redirect('/Services+Landscape+for+e-Health', 'https://openehr.atlassian.net/wiki/spaces/spec/pages/357957633/Services+Landscape+for+e-Health', 302);
    $app->redirect('/UML[/]', '/releases/UML/' . Release::DEVELOPMENT . '/index.html', 301);
    // legacy
    $app->get('/latest_releases[/]', Action\ReleasesAction::class);
    $app->get('/historical_releases[/]', Action\ReleasesAction::class);
    $app->get('/working_baseline[/]', Action\DevelopmentBaselineAction::class);
};

