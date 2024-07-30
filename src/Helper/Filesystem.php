<?php

namespace App\Helper;

use RuntimeException;

final class Filesystem
{
    public static function assureWritableDirectory(string $directory, bool $suppressException = false): bool
    {
        if (!is_dir($directory)) {
            if (is_file($directory) || is_link($directory)) {
                return $suppressException ? false : throw new RuntimeException(
                    sprintf('The [%s] already exist but is not a directory.', $directory)
                );
            }
            if (!@mkdir($directory, 0777, true) && !is_dir($directory)) {
                return $suppressException ? false : throw new RuntimeException(
                    sprintf('Directory [%s] does not exist and cannot be created.', $directory)
                );
            }
        }
        if (!is_writable($directory)) {
            return $suppressException ? false : throw new RuntimeException(
                sprintf('Directory [%s] is not writable.', $directory)
            );
        }
        return true;
    }

    public static function checkReadableDirectory(string $directory, bool $suppressException = false): bool
    {
        if (!file_exists($directory) || !is_readable($directory)) {
            return $suppressException ? false : throw new RuntimeException(
                sprintf('Directory [%s] does not exists or is not readable.', $directory)
            );
        }
        if (!is_dir($directory)) {
            return $suppressException ? false : throw new RuntimeException(
                sprintf('The [%s] is not a directory.', $directory)
            );
        }
        return true;
    }

    public static function checkReadableFile(string $file, bool $suppressException = false): bool
    {
        if (!file_exists($file) || !is_readable($file)) {
            return $suppressException ? false : throw new RuntimeException(
                sprintf('File [%s] does not exists or is not readable.', $file)
            );
        }
        if (!is_file($file)) {
            return $suppressException ? false : throw new RuntimeException(
                sprintf('The [%s] is not a file.', $file)
            );
        }
        return true;
    }
}
