<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class ReleasesAction
{
    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $response->getBody()->write('releases');

        return $response;
    }
}