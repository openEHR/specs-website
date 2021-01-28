<?php

namespace App\Action;

use App\Domain\Service\ComponentService;
use App\View;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class StartAction
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
            'title' => 'Start',
            'page' => 'start',
            'releases' => $this->componentService->getReleases(),
            'components' => $this->componentService->getComponents(),
        ];
        return $this->view->render($response, 'page/start.phtml', $data);
    }
}
