<?php

namespace App\Action;

use App\Domain\Service\ComponentService;
use App\View;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class DevelopmentBaselineAction
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
        $data = $this->componentService->getComponents();
        return $this->view->addAttribute('page', 'development_baseline')
            ->addAttribute('title', 'Development Baseline')
            ->render($response, 'page/all_components.phtml', $data);
    }

    public function manifest(ServerRequest $request, Response $response): Response
    {
        $data = $this->componentService->build()->getData();
        return $response->withJson($data);
    }

    public function classes(ServerRequest $request, Response $response, array $args): Response
    {
        $components = $this->componentService->getComponents();
        if (!empty($args['class'])) {
            foreach ($components as $component) {
                try {
                    $type = $component->getTypeByName($args['class']);
                    return $response->withRedirect($type->getLink());
                } catch (\Exception $e) {
                    // silently do nothing
                }
            }
        }
        $data = [
            'components' => $components,
        ];
        return $this->view->addAttribute('page', 'class_index')
            ->addAttribute('title', 'Class Index')
            ->render($response, 'page/class_index.phtml', $data);
    }

}
