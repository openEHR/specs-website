<?php


namespace App\Action;

use App\Configuration;
use App\Helper\File;
use App\View;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class HookAction
{
    protected $view;
    protected $settings;

    public function __construct(View $view, Configuration $settings)
    {
        $this->view = $view;
        $this->settings = $settings;
    }

    public function populate_releases(ServerRequest $request, Response $response, array $args): Response
    {
        if ($this->settings->hook_secret) {
            if (!extension_loaded('hash')) {
                throw new HttpBadRequestException($request, 'Missing [hash] extension for checking hook signature.');
            }
            $hubSignature = current($request->getHeader('HTTP_X_HUB_SIGNATURE'));
            if (empty($hubSignature)) {
                throw new HttpBadRequestException($request, 'Missing hub signature header.');
            }
            [$algo, $hash] = explode('=', $hubSignature, 2) + array('', '');
            if (!in_array($algo, hash_algos(), true)) {
                throw new HttpBadRequestException($request, "Signature hash algorithm '$algo' is not supported.");
            }
            if (!hash_equals($hash, hash_hmac($algo, file_get_contents('php://input'), $this->settings->hook_secret))) {
                throw new HttpBadRequestException($request, 'Invalid hook signature.');
            }
        }

        $payload = $request->getParam('payload');
        $payload = $payload ? json_decode($payload, true) : null;
        if (empty($payload)) {
            if (json_last_error()) {
                $err = ' (JSON error: ' . json_last_error_msg() . ')';
            } else {
                $err = '';
            }
            throw new HttpBadRequestException($request, 'Invalid or empty hook payload.' . $err);
        }

        // check origin and owner
        $owner = $payload['repository']['owner'];
        if ('openEHR' !== $owner['name'] || 'Organization' !== $owner['type']) {
            throw new HttpBadRequestException($request, "Wrong caller: \n" . print_r($owner, true));
        }

        $repo_name = $payload['repository']['name'];
        $command = $this->settings->root . "/scripts/spec_populate_releases.sh $repo_name 2>&1";

        exec($command, $cmd_output);
        $output = implode(PHP_EOL, $cmd_output);

        $response->getBody()->write($output);
        return $response
            ->withHeader('Content-Type', 'text/plain');
    }
}
