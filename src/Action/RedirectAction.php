<?php

namespace App\Action;

use App\Configuration;
use App\Domain\Service\ComponentService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class RedirectAction
{

    public function __construct(protected ComponentService $componentService, protected Configuration $settings)
    {
    }

    public function jira(ServerRequest $request, Response $response, array $args): Response
    {
        $component = $this->componentService->getComponent($args['component'])->useRelease($args['release'] ?? '');
        $location = match ($args['alias'] ?? '') {
            'open_issues' => sprintf($this->settings->jira_open_issues, $component->jira->open_issues),
            'history' => sprintf($this->settings->jira_history, $component->jira->roadmap),
            'roadmap' => sprintf($this->settings->jira_roadmap, $component->jira->roadmap),
            'crs' => sprintf($this->settings->jira_crs, $component->jira->roadmap),
            'issues' => sprintf($this->settings->jira_issues, $component->release->jira->prs),
            'changes' => sprintf($this->settings->jira_changes, $component->release->jira->crs),
            default => $component->release->getLink(),
        };
        return $response->withRedirect($location);
    }

    public function components(ServerRequest $request, Response $response, array $args): Response
    {
        $location = '/releases/' . ($args['asset'] ?? '');
        return $response->withRedirect($location, 301);
    }

    public function tickets(ServerRequest $request, Response $response, array $args): Response
    {
        $location = sprintf($this->settings->jira_tickets, $args['issue'] ?? '');
        return $response->withRedirect($location);
    }

    public function wiki(ServerRequest $request, Response $response, array $args): Response
    {
        $location = $this->settings->wiki_home . '/' . ($args['wiki'] ?? '');
        return $response->withRedirect($location);
    }

}
