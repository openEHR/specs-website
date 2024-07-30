<?php

namespace App;

use App\Helper\Filesystem;

class Context
{

    public function __construct(
        public readonly string $dir = '',
        public readonly string $cacheDir = '',
        public readonly string $releasesDir = '',
        public readonly Environment $environment = Environment::PRODUCTION,
        public readonly bool $debug = false,
    ) {
    }

    /**
     * Instantiate an App Context based on current environment.
     *
     * The following env-vars are playing a role in detecting contact values:
     *  - APP_CACHE_DIR env-var, or '/tmp/cache' (default)
     *  - RELEASES_ROOT env-var, or '/data/releases' (default)
     *  - APP_ENV env-var, or 'production' (default)
     *  - APP_DEBUG env-var, or 'false' (default)
     *
     * @return self
     */
    public static function fromEnv(): self
    {
        // return Context based on env-vars and composer (data as defaults)
        return new Context(
            dir: dirname(__DIR__),
            cacheDir: (string)getenv('APP_CACHE_DIR') ?: '/tmp/cache',
            releasesDir: (string)getenv('RELEASES_ROOT') ?: '/data/releases',
            environment: Environment::tryFrom((string)getenv('APP_ENV')) ?? Environment::PRODUCTION,
            debug: (bool)filter_var((string)getenv('APP_DEBUG'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        );
    }

    public function install(): void
    {
        $debugLevel = $this->debug ? E_ALL : (E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
        error_reporting($this->isProduction() ? 0 : $debugLevel);
        ini_set('display_errors', $this->isProduction() ? '0' : '1');
        ini_set('display_startup_errors', $this->isProduction() ? '0' : '1');
        Filesystem::assureWritableDirectory($this->cacheDir);
        Filesystem::checkReadableDirectory($this->releasesDir);
        date_default_timezone_set('UTC');
    }

    /**
     * @return string
     * @deprecated Use `cacheDir` property instead
     */
    public function getVarCachePath(): string
    {
        return $this->cacheDir;
    }

    public function isProduction(): bool
    {
        return $this->environment === Environment::PRODUCTION;
    }

    public function isTest(): bool
    {
        return $this->environment === Environment::TEST;
    }

    public function isDevelopment(): bool
    {
        return $this->environment === Environment::DEVELOPMENT;
    }

    public static function isCli(): bool
    {
        return PHP_SAPI === 'cli';
    }

}
