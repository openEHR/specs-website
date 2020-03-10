<?php

namespace App\Action;

use App\View;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class HistoricalReleasesAction
{

    protected $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function __invoke(ServerRequest $request, Response $response, array $args): Response
    {
        $data = [
            'title' => 'Historical Releases',
            'page' => 'historical_releases',
        ];
        return $this->view->render($response, 'historical_releases.phtml', $data);
    }

}