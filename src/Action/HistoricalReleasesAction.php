<?php

namespace App\Action;

use App\Configuration;
use App\Helper\File;
use App\View;
use Slim\Exception\HttpNotFoundException;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class HistoricalReleasesAction
{
    protected $view;
    protected $settings;

    public function __construct(View $view, Configuration $settings)
    {
        $this->view = $view;
        $this->settings = $settings;
    }

    public function index(ServerRequest $request, Response $response, array $args): Response
    {
        $template = "page/historical_releases/{$args['release']}.phtml";
        $data = [
            'title' => "Release {$args['release']}",
        ];
        return $this->view->render($response, $template, $data);
    }

    public function assets(ServerRequest $request, Response $response, array $args): Response
    {
        $filename = "{$this->settings->sites_root}/releases/{$args['release']}/{$args['asset']}";
        $file = new File($filename);
        if (!$file->hasContents()) {
            throw new HttpNotFoundException($request, "Asset file ({$args['asset']}) from historical release ({$args['release']}) not found.");
        }
        $response->getBody()->write($file->getContents());
        return $response->withHeader('Last-Modified', gmdate('D, d M Y H:i:s T', $file->getLastModified()))
            ->withHeader('Cache-Control', 'public, max-age=' . (int)$this->settings->cache_max_age)
            ->withHeader('Content-Type', $file->getContentType());
    }
}
