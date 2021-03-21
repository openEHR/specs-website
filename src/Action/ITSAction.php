<?php

namespace App\Action;

use App\Configuration;
use App\Domain\Service\ComponentService;
use App\Helper\File;
use App\View;
use Slim\Exception\HttpNotFoundException;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class ITSAction
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

    public function __invoke(ServerRequest $request, Response $response, array $args): Response
    {
        $data = $this->componentService->getComponents();
        return $this->view->addAttribute('page', 'implementation_technologies')
            ->addAttribute('title', 'Implementation Technologies')
            ->render($response, 'page/its.phtml', $data);
    }

    public function dir_viewer(ServerRequest $request, Response $response, array $args): Response
    {
        $component = $this->componentService->getComponent($args['component'])->useRelease($args['release']);
        $asset = $component->getITSAsset($args['asset'] ?? '');
        if (!$asset->isReadable()) {
            throw new HttpNotFoundException($request, "ITS asset ({$args['component']},{$args['release']},{$args['asset']}) not found.");
        }
        if ($asset->isDir()) {
            $data = [
                'component' => $component,
                'dir' => $asset,
                'page' => "{$component->id}_its_dir_viewer",
                'title' => "{$component->title} ({$component->id}) Component - {$component->release->id}",
            ];
            return $this->view->render($response, 'page/its_dir_viewer.phtml', $data);
        }
        $file = new File($asset->getRealPath());
        if (!$file->hasContents()) {
            throw new HttpNotFoundException($request, "File ({$args['component']},{$args['release']},{$args['asset']}) not found.");
        }
        $response->getBody()->write($file->getContents());
        return $response->withHeader('Last-Modified', gmdate('D, d M Y H:i:s T', $file->getLastModified()))
            ->withHeader('Cache-Control', 'public, max-age=' . (int)$this->settings->cache_max_age)
            ->withHeader('Content-Type', $file->getContentType());
    }
}
