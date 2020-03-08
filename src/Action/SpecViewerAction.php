<?php

namespace App\Action;

use App\Configuration;
use Slim\Exception\HttpNotFoundException;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class SpecViewerAction
{
    protected $settings;

    public function __construct(Configuration $settings)
    {
        $this->settings = $settings;
    }

    public function pages(ServerRequest $request, Response $response, array $args): Response
    {
        $sites_root = $this->settings->sites_root;
        $specs_root = "{$sites_root}/releases";
        $component = $args['component'];
        $release = $args['release'];
        $page = $args['page'] ?: 'index.html';
        $spec_file = "{$specs_root}/{$component}/{$release}/docs/{$page}";
        if (!is_readable($spec_file) || !($content = file_get_contents($spec_file))) {
            throw new HttpNotFoundException($request, 'Invalid specification URL: ' . $spec_file);
        }
        $response->getBody()->write($content);
        return $response;
    }

    public function diagrams(ServerRequest $request, Response $response, array $args): Response
    {
        $sites_root = $this->settings->sites_root;
        $specs_root = "{$sites_root}/releases";
        $component = $args['component'];
        $release = $args['release'];
        $im = $args['im'];
        $diagram = $args['diagram'];
        $diagram_file = "{$specs_root}/{$component}/{$release}/docs/{$im}/diagrams/{$diagram}";
        if (!is_readable($diagram_file) || !($content = file_get_contents($diagram_file))) {
            throw new HttpNotFoundException($request);
        }
        $response->getBody()->write($content);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $contentType = finfo_file($finfo, $diagram_file);
        $time = filemtime($diagram_file);
        return $response->withHeader('Cache-Control', 'public, max-age=' . (int)$this->settings->cache_max_age)
            ->withHeader('Last-Modified', gmdate('D, d M Y H:i:s T', $time))
            ->withHeader('Content-Type', $contentType)
            ->withHeader('Content-Length', mb_strlen($content));
    }
}