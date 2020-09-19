<?php

namespace App\Action;

use App\Domain\Service\ComponentService;
use App\View;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class ReleasesAction
{
    protected $view;
    protected $componentService;

    public function __construct(View $view, ComponentService $components)
    {
        $this->view = $view;
        $this->componentService = $components;
    }

    public function __invoke(ServerRequest $request, Response $response, array $args): Response
    {
        $data = [
            'title' => 'Latest Releases',
            'page' => 'latest_releases',
            'releases' => $this->componentService->getReleases(),
        ];
        return $this->view->render($response, 'page/latest_releases.phtml', $data);
    }
}
