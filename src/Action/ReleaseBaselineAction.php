<?php

namespace App\Action;

use App\Domain\Data\Release;
use App\Domain\Service\ComponentService;
use App\View;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class ReleaseBaselineAction
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
        foreach ($this->componentService->getComponents() as $component) {
            $component->useRelease(Release::STABLE);
        }
        $data = $this->componentService->getComponents();
        return $this->view->addAttribute('page', 'release_baseline')
            ->addAttribute('title', 'Release Baseline')
            ->render($response, 'page/all_components.phtml', $data);
    }

}
