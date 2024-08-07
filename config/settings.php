<?php

use App\Domain\Data\Release;
use App\View\Page;

// Settings
$settings = [];

// Path settings
$settings['cache_max_age'] = 3600;
$settings['hook_secret'] = (string)getenv('APP_HOOK_SECRET');

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
        'Architecture Overview' => '/releases/BASE/' . Release::DEVELOPMENT . '/architecture_overview.html',
        'Archetype Technology' => '/releases/AM/' . Release::DEVELOPMENT . '/Overview.html',
        'Implementation Technologies' => '/its',
        Page::DIVIDER,
        'All Components' => '/components',
        'All Releases' => '/releases',
        'Global UML' => '/releases/UML/' . Release::DEVELOPMENT . '/index.html',
        'Class Index' => '/classes',
    ],
    'Specifications' => [
        'Architecture Overview' => '/releases/BASE/' . Release::DEVELOPMENT . '/architecture_overview.html',
//        'Conformance Specifications' => '/releases/CNF/' . Release::LATEST,
        Page::DIVIDER,
        'Implementation Technologies' => Page::HEADER,
        'ITS Overview' => '/its',
//        'ITS Specifications' => '/releases/ITS/' . Release::LATEST,
        'REST APIs' => '/releases/ITS-REST/' . Release::LATEST,
        'JSON Schema' => '/releases/ITS-JSON/' . Release::LATEST,
        'XML Schema' => '/releases/ITS-XML/' . Release::LATEST,
        'BMMs' => '/releases/ITS-BMM/' . Release::LATEST,
        Page::DIVIDER,
//        'Platform services' => Page::HEADER,
//        'Service Model Specifications' => '/releases/SM/' . Release::LATEST,
        'Process and CDS' => Page::HEADER,
        'Clinical Decision Support' => '/releases/CDS/' . Release::LATEST,
//        'Process Model' => '/releases/PROC/' . Release::LATEST,
        'Content' => Page::HEADER,
        'Reference Model' => '/releases/RM/' . Release::LATEST,
        'openEHR Terminology' => '/releases/TERM/' . Release::LATEST,
        'Formalisms' => Page::HEADER,
        'Query Languages' => '/releases/QUERY/' . Release::LATEST,
        'Archetype Model' => '/releases/AM/' . Release::LATEST,
        'Generic Languages' => '/releases/LANG/' . Release::LATEST,
        'Foundations' => Page::HEADER,
        'Base Model' => '/releases/BASE/' . Release::LATEST,
    ],
    'Community' => [
        'Issue Trackers' => 'https://openehr.atlassian.net/secure/Dashboard.jspa?selectPageId=10190',
        'Discourse Forum' => 'https://discourse.openehr.org/c/specifications',
        'Wiki' => '/wiki/display/spec/Specifications+Home',
        'GitHub' => 'https://github.com/openEHR',
//        'Slack' => 'https://openehrspecs.slack.com/',
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
