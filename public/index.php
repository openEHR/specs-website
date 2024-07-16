<?php

try {
    (require __DIR__ . '/../config/bootstrap.php')->run();
} catch (\Throwable $exception) {
    if (!headers_sent()) {
        header('HTTP/1.1 500 Internal Server Error', true, 500);
    }
    error_log((string)$exception);
    echo "Bootstrap error - check server logs.";
    exit(1);
}
