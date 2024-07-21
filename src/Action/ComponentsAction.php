<?php

namespace App\Action;

use App\Domain\Data\Release;
use App\Domain\Service\ComponentService;
use App\View;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class ComponentsAction
{

    public function __construct(protected View $view, protected ComponentService $componentService)
    {
    }

    public function __invoke(ServerRequest $request, Response $response, array $args): Response
    {
        foreach ($this->componentService->getComponents() as $component) {
            $component->useRelease(Release::LATEST);
        }
        $data = [
            'page' => 'components',
            'title' => 'All Components',
        ] + $this->componentService->getComponents();
        return $this->view->render($response, 'page/components.phtml', $data);
    }
}
