<?php

namespace App\Action;

use App\Domain\Service\ComponentService;
use App\View;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class ReleasesAction
{

    public function __construct(protected View $view, protected ComponentService $componentService)
    {
    }

    public function __invoke(ServerRequest $request, Response $response, array $args): Response
    {
        $data = [
            'page' => 'releases',
            'title' => 'Releases',
            'releases' => $this->componentService->getReleases(),
        ];
        return $this->view->render($response, 'page/releases.phtml', $data);
    }
}
