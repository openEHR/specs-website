<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class SpecViewerAction
{
    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $response->getBody()->write('specs');

        return $response;
    }
}