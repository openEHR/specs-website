<?php

namespace App\Action;

use App\Domain\Data\Release;
use App\Domain\Service\ComponentService;
use App\View;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class ComponentsAction
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
        foreach ($this->componentService->getComponents() as $component) {
            $component->useRelease(Release::STABLE);
        }
        $data = [
            'page' => 'components',
            'title' => 'All Components',
        ] + $this->componentService->getComponents();
        return $this->view->render($response, 'page/components.phtml', $data);
    }
}
