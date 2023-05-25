<?php

namespace App\Action;

use App\Domain\Service\ComponentService;
use App\View;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class StartAction
{

    public function __construct(protected View $view, protected ComponentService $componentService)
    {
    }

    public function __invoke(ServerRequest $request, Response $response, array $args): Response
    {
        $data = [
            'title' => 'Specifications Start Page',
            'page' => 'start',
            'releases' => $this->componentService->getReleases(),
            'components' => $this->componentService->getComponents(),
        ];
        return $this->view->render($response, 'page/start.phtml', $data);
    }
}
