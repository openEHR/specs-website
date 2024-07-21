<?php

namespace App\Action;

use App\Domain\Data\Release;
use App\Domain\Service\ComponentService;
use App\View;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class ReleaseBaselineAction
{

    public function __construct(protected View $view, protected ComponentService $componentService)
    {
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        foreach ($this->componentService->getComponents() as $component) {
            $component->useRelease(Release::LATEST);
        }
        $data = $this->componentService->getComponents();
        return $this->view->addAttribute('page', 'release_baseline')
            ->addAttribute('title', 'Release Baseline')
            ->render($response, 'page/baseline.phtml', $data);
    }

}
