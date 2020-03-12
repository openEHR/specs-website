<?php

namespace App\Action;

use App\Domain\ComponentService;
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

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $response->getBody()->write('releases');

        $data = [
                'title' => 'Latest Releases',
                'page' => 'latest_releases',
            ] + $this->componentService->getComponents();
        return $this->view->render($response, 'latest_releases.phtml', $data);
    }

    public function historical(ServerRequest $request, Response $response, array $args): Response
    {
        $data = [
            'title' => 'Historical Releases',
            'page' => 'historical_releases',
        ];
        return $this->view->render($response, 'historical_releases.phtml', $data);
    }
}