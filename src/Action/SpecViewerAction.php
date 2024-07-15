<?php

namespace App\Action;

use App\Configuration;
use App\Domain\Service\ComponentService;
use App\Helper\File;
use App\View;
use Slim\Exception\HttpNotFoundException;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class SpecViewerAction
{

    public function __construct(protected View $view, protected ComponentService $componentService, protected Configuration $settings)
    {
    }

    public function index(ServerRequest $request, Response $response, array $args): Response
    {
        $args['release'] = $args['release'] ?? '';
        $component = $this->componentService->getComponent($args['component'])->useRelease($args['release']);
        $release = $component->release;
        if ($request->getRequestTarget() !== $release->getLink()) {
            return $response->withRedirect($release->getLink(), 301);
        }
        $data = array_merge(
            (array)$release->component,
            [
                'page' => "{$component->id}_component",
                'title' => "{$component->title} ({$component->id}) Component - {$component->release->id}",
                'component' => $component,
                'releases' => $component->releases
            ]
        );
        return $this->view->render($response, 'page/component_index.phtml', $data);
    }

    public function specs(ServerRequest $request, Response $response, array $args): Response
    {
        $specification = $this->componentService->getComponent($args['component'])->useRelease($args['release'])->getSpecificationById($args['spec']);
        $file = new File($specification->getFilename());
        if (!$file->hasContents()) {
            throw new HttpNotFoundException($request, "Specification file ({$args['component']},{$args['release']},{$args['spec']}) not found.");
        }
        $response->getBody()->write($file->getContents());
        return $response->withHeader('Last-Modified', gmdate('D, d M Y H:i:s T', $file->getLastModified()));
    }

    public function assets(ServerRequest $request, Response $response, array $args): Response
    {
        $component = $this->componentService->getComponent($args['component'])->useRelease($args['release']);
        $file = new File($component->getAssetFilename($args['asset']));
        if (!$file->hasContents()) {
            $file = new File($component->getScriptsAssetFilename($args['asset']));
            if (!$file->hasContents()) {
                $file = new File($component->getTestsAssetFilename($args['asset']));
                if (!$file->hasContents()) {
                    $file = new File($component->getComputableAssetFilename($args['asset']));
                    if (!$file->hasContents()) {
                        throw new HttpNotFoundException($request, "Asset file ({$args['component']},{$args['release']},{$args['asset']}) not found.");
                    }
                }
            }
        }
        $response->getBody()->write($file->getContents());
        return $response->withHeader('Last-Modified', gmdate('D, d M Y H:i:s T', $file->getLastModified()))
            ->withHeader('Cache-Control', 'public, max-age=' . (int)$this->settings->cache_max_age)
            ->withHeader('Content-Type', $file->getContentType());
    }

}
