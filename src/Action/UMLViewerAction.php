<?php

namespace App\Action;

use App\Configuration;
use App\Context;
use App\Domain\Data\Release;
use App\Helper\File;
use Slim\Exception\HttpNotFoundException;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class UMLViewerAction
{

    public function __construct(protected Configuration $settings, protected Context $appContext)
    {
    }

    public function assets(ServerRequest $request, Response $response, array $args): Response
    {
        $asset = !empty($args['asset']) ? $args['asset'] : 'index.html';
        $filename = "{$this->appContext->releasesDir}/UML/" . Release::DEVELOPMENT . "/$asset";
        $file = new File($filename);
        if (!$file->hasContents()) {
            throw new HttpNotFoundException($request, "Asset file ($asset) from (UML Viewer) not found.");
        }
        $response->getBody()->write($file->getContents());
        return $response->withHeader('Last-Modified', gmdate('D, d M Y H:i:s T', $file->getLastModified()))
            ->withHeader('Cache-Control', 'public, max-age=' . (int)$this->settings->cache_max_age)
            ->withHeader('Content-Type', $file->getContentType());
    }
}
