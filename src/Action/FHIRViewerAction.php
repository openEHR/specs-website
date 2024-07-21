<?php

namespace App\Action;

use App\Configuration;
use App\Domain\Data\Release;
use App\Domain\Service\ComponentService;
use App\Helper\File;
use Slim\Exception\HttpNotFoundException;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class FHIRViewerAction
{

    public function __construct(protected ComponentService $componentService, protected Configuration $settings)
    {
    }

    public function assets(ServerRequest $request, Response $response, array $args): Response
    {
        $component = $this->componentService->getComponent('TERM')->useRelease(Release::DEVELOPMENT);
        $file = new File($component->getComputableAssetFilename('fhir/'.$args['asset'].'.xml'));
        if (!$file->hasContents()) {
            throw new HttpNotFoundException($request, "FHIR Asset file ({$args['asset']}) not found.");
        }
        $response->getBody()->write($file->getContents());
        return $response->withHeader('Last-Modified', gmdate('D, d M Y H:i:s T', $file->getLastModified()))
            ->withHeader('Cache-Control', 'public, max-age=' . (int)$this->settings->cache_max_age)
            ->withHeader('Content-Type', $file->getContentType());
    }
}
