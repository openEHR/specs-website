<?php

namespace App\Action;

use App\Configuration;
use App\Domain\ComponentService;
use App\View;
use Slim\Exception\HttpNotFoundException;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class SpecViewerAction
{
    protected $view;
    protected $componentService;
    protected $settings;

    public function __construct(View $view, ComponentService $components, Configuration $settings)
    {
        $this->view = $view;
        $this->componentService = $components;
        $this->settings = $settings;
    }

    public function index(ServerRequest $request, Response $response, array $args): Response
    {
        $components = $this->componentService->getComponents();
        if (!isset($components[$args['component']])) {
            throw new HttpNotFoundException($request, 'Invalid specification component: ' . $args['component']);
        }
        $component = $components[$args['component']];
        if (!empty($args['release'])) {
            $component->setRelease($args['release']);
        }
        $data = (array)$component + [
                'page' => "{$component->id}_component",
            ];
        return $this->view->render($response, 'component.phtml', $data);
    }

    public function specs(ServerRequest $request, Response $response, array $args): Response
    {
        $file = $this->componentService->getSpecFile($args['component'], $args['release'], $args['spec']);
        if (!$file->isValid() || !$file->hasContents()) {
            throw new HttpNotFoundException($request, 'Specification file not found.');
        }
        $response->getBody()->write($file->getContents());
        return $response->withHeader('Last-Modified', gmdate('D, d M Y H:i:s T', $file->getLastModified()));
    }

    public function diagrams(ServerRequest $request, Response $response, array $args): Response
    {
        $file = $this->componentService->getDiagramFile($args['component'], $args['release'], $args['spec'], $args['diagram']);
        if (!$file->isValid() || !$file->hasContents()) {
            throw new HttpNotFoundException($request, 'Diagram file not found.');
        }
        $response->getBody()->write($file->getContents());
        return $response->withHeader('Last-Modified', gmdate('D, d M Y H:i:s T', $file->getLastModified()))
            ->withHeader('Cache-Control', 'public, max-age=' . (int)$this->settings->cache_max_age)
            ->withHeader('Content-Type', $file->getContentType());
    }
}
