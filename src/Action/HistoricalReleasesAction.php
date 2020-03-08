<?php

namespace App\Action;

use Psr\Container\ContainerInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class HistoricalReleasesAction
{

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(ServerRequest $request, Response $response, array $args): Response
    {
        $renderer = $this->container->get('view');
        $data = [
            'title' => 'Historical Releases',
            'page' => 'historical_releases',
        ];
        return $renderer->render($response, 'historical_releases.phtml', $data);
    }

}