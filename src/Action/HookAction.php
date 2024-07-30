<?php


namespace App\Action;

use App\Configuration;
use App\Context;
use App\Domain\Service\ComponentService;
use RuntimeException;
use Slim\Exception\HttpBadRequestException;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Throwable;

final class HookAction
{

    public function __construct(protected Configuration $settings, protected Context $appContext, protected ComponentService $componentService)
    {
    }

    public function populate_releases(ServerRequest $request, Response $response, array $args): Response
    {
        $output = '';
        if ($this->settings->hook_secret) {
            if (!extension_loaded('hash')) {
                throw new RuntimeException('Missing [hash] extension for checking hook signature.');
            }
            $hubSignature = current($request->getHeader('X-HUB-SIGNATURE'));
            if (empty($hubSignature)) {
                throw new HttpBadRequestException($request, 'Missing hub signature header (X-HUB-SIGNATURE).');
            }
            [$algo, $hash] = explode('=', $hubSignature, 2) + array('', '');
            if (!in_array($algo, hash_algos(), true)) {
                throw new HttpBadRequestException($request, "Signature hash algorithm '$algo' is not supported.");
            }
            $known_string = hash_hmac($algo, file_get_contents('php://input'), $this->settings->hook_secret);
            if (!hash_equals($known_string, $hash)) {
                throw new HttpBadRequestException($request, "Invalid hook signature [$hubSignature].");
            }
            $output .= 'Hook secret: checked';
            $response = $response->withHeader('X-HOOK-SIGNATURE', 'ok');
        }

        // parse payload
        try {
            $payload = json_decode($request->getParam('payload'), true, 512, JSON_BIGINT_AS_STRING | JSON_THROW_ON_ERROR);
            $data = new Configuration($payload);
        } catch (Throwable $e) {
            throw new HttpBadRequestException($request, 'Invalid content payload. Reason: ' . $e->getMessage(), previous: $e);
        }

        // check origin and owner
        $owner = $data->repository->owner ?? new Configuration();
        if ('openEHR' !== $owner->name || 'Organization' !== $owner->type) {
            throw new HttpBadRequestException($request, "Wrong caller: \n" . print_r($owner, true));
        }

        $repo_name = $data->repository->name ?? '';
        if (!$repo_name) {
            throw new HttpBadRequestException($request, "Missing repository name: \n" . print_r($data->repository, true));
        }
        $command = $this->appContext->dir . "/scripts/spec_populate_releases.sh $repo_name 2>&1";
        $output .= PHP_EOL. "Updating $repo_name:";
        $response = $response->withHeader('X-HOOK-UPDATING', $repo_name);

        exec($command, $cmd_output, $result_code);
        if ($this->appContext->debug) {
            $output .= PHP_EOL. implode(PHP_EOL, $cmd_output);
            $response = $response->withHeader('X-HOOK-UPDATING-LOG', strlen($output));
        } else {
            $output .= ' ok';
        }
        $response = $response->withHeader('X-HOOK-RESULT-CODE', $result_code);

        $this->componentService->build();

        error_log($output);
        $response->getBody()->write($output);
        return $response
            ->withHeader('Content-Type', 'text/plain');
    }
}
