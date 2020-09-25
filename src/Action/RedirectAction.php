<?php

namespace App\Action;

use App\Configuration;
use App\Domain\Service\ComponentService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class RedirectAction
{
    protected $componentService;
    protected $settings;

    public function __construct(ComponentService $components, Configuration $settings)
    {
        $this->componentService = $components;
        $this->settings = $settings;
    }

    public function jira(ServerRequest $request, Response $response, array $args): Response
    {
        $component = $this->componentService->getComponent($args['component'])->useRelease($args['release'] ?? '');
        switch ($args['alias'] ?? '') {
            case 'open_issues':
                $location = sprintf($this->settings->jira_open_issues, $component->jira->open_issues);
                break;
            case 'history':
                $location = sprintf($this->settings->jira_history, $component->jira->roadmap);
                break;
            case 'roadmap':
                $location = sprintf($this->settings->jira_roadmap, $component->jira->roadmap);
                break;
            case 'crs':
                $location = sprintf($this->settings->jira_crs, $component->jira->roadmap);
                break;
            case 'issues':
                $location = sprintf($this->settings->jira_issues, $component->release->jira->prs);
                break;
            case 'changes':
                $location = sprintf($this->settings->jira_changes, $component->release->jira->crs);
                break;
            default:
                $location = $component->release->getLink();
        }
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
