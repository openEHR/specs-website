<?php


namespace App\Action;


use App\Domain\Service\SearchService;
use App\View;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

class SearchAction
{

    public function __construct(protected View $view, protected SearchService $searchService)
    {
    }

    public function __invoke(ServerRequest $request, Response $response, array $args): Response
    {
        $keyword = $request->getQueryParam('keyword', '');
        $data = $this->searchService->query($keyword) + [
            'title' => 'Search results',
            'page' => 'search_results',
            'keyword' => $keyword,
        ];
        return $this->view->render($response, 'page/search_results.phtml', $data);
    }

}
