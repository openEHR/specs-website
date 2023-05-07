<?php

use App\View\Page;

// Error reporting
error_reporting(0);
ini_set('display_errors', '0');

// Timezone
date_default_timezone_set('UTC');

// Settings
$settings = [];

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['temp'] = '/tmp';
$settings['git_root'] = '/var/www/git';
$settings['sites_root'] = '/var/www/vhosts/openehr.org/specifications.openehr.org';
$settings['cache_max_age'] = 3600;
$settings['hook_secret'] = '';

// Error Handling Middleware settings
$settings['error_handler_middleware'] = [
    // Should be set to false in production
    'display_error_details' => false,
    // Parameter is passed to the default ErrorHandler
    // View in rendered output by enabling the "displayErrorDetails" setting.
    // For the console and unit tests we also disable it
    'log_errors' => true,
    // Display error details in error log
    'log_error_details' => true,
];

$settings['jira_home'] = 'https://openehr.atlassian.net';
$settings['jira_issues'] = $settings['jira_home'] . '/projects/%s';
$settings['jira_changes'] = $settings['jira_home'] . '/projects/%s';
$settings['jira_open_issues'] = $settings['jira_home'] . '/issues/?filter=%s';
$settings['jira_roadmap'] = $settings['jira_home'] . '/projects/%s?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin:release-page&status=unreleased';
$settings['jira_history'] = $settings['jira_home'] . '/projects/%s?selectedItem=com.atlassian.jira.jira-projects-plugin:release-page&status=released';
$settings['jira_crs'] = $settings['jira_home'] . '/projects/%s?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin:release-page&status=released-unreleased';
$settings['jira_tickets'] = $settings['jira_home'] . '/browse/%s';
$settings['wiki_home'] = 'https://openehr.atlassian.net/wiki';

$settings['view'] = [
    'templates' => $settings['root'] . '/templates',
    'layout' => 'layout/layout.phtml',
    'attributes' => [
        'title' => '',
        'page' => '',
    ],
];

$settings['navbar'] = [
    'Home' => [
        'Start' => '/start',
        'Release Baseline' => '/release_baseline',
        'Development Baseline' => '/development_baseline',
        Page::DIVIDER,
        'Architecture Overview' => '/releases/BASE/latest/architecture_overview.html',
        'Archetype Technology' => '/releases/AM/latest/Overview.html',
        'Implementation Technologies' => '/its',
        Page::DIVIDER,
        'All Components' => '/components',
        'All Releases' => '/releases',
        'Global UML' => '/releases/UML/latest/index.html',
        'Class Index' => '/classes',
    ],
    'Specifications' => [
        'Architecture Overview' => '/releases/BASE/latest/architecture_overview.html',
        'Conformance Specifications' => '/releases/CNF/stable',
        Page::DIVIDER,
        'Implementation Technologies' => Page::HEADER,
        'ITS Specifications' => '/releases/ITS/stable',
        'REST APIs' => '/releases/ITS-REST/stable',
        'JSON Schema' => '/releases/ITS-JSON/stable',
        'XML Schema' => '/releases/ITS-XML/stable',
        'BMMs' => '/releases/ITS-BMM/stable',
        Page::DIVIDER,
        'Platform services' => Page::HEADER,
        'Service Model Specifications' => '/releases/SM/stable',
        'Process and CDS' => Page::HEADER,
        'Clinical Decision Support' => '/releases/CDS/stable',
        'Process Model' => '/releases/PROC/stable',
        'Content' => Page::HEADER,
        'Reference Model' => '/releases/RM/stable',
        'openEHR Terminology' => '/releases/TERM/stable',
        'Formalisms' => Page::HEADER,
        'Query Languages' => '/releases/QUERY/stable',
        'Archetype Model' => '/releases/AM/stable',
        'Generic Languages' => '/releases/LANG/stable',
        'Foundations' => Page::HEADER,
        'Base Model' => '/releases/BASE/stable',
    ],
    'Community' => [
        'Issue Trackers' => 'https://openehr.atlassian.net/secure/Dashboard.jspa?selectPageId=10190',
        'Discourse Forum' => 'https://discourse.openehr.org/c/specifications',
        'Wiki' => '/wiki/display/spec/Specifications+Home',
        'GitHub' => 'https://github.com/openEHR',
        'Slack' => 'https://openehrspecs.slack.com/',
    ],
    'Governance' => [
        'Specification Program' => 'https://www.openehr.org/programs/specification',
        'Specification Governance' => 'https://www.openehr.org/programs/specification/governance',
        'Change process' => 'https://www.openehr.org/programs/specification/changeprocess',
        'Release Strategy' => 'https://www.openehr.org/programs/specification/releasestrategy',
        'SEC Members' => 'https://www.openehr.org/programs/specification/editorialcommittee',
        Page::DIVIDER,
        'Organisational Structure' => 'https://www.openehr.org/governance/organisational_structure',
        'IP and Licensing' => 'https://www.openehr.org/governance/intellectual_property',
    ]
];

return $settings;
