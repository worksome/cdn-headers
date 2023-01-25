<?php

namespace Worksome\CdnHeaders;

class ServerHeadersRepository
{
    /**
     * @return non-empty-string|null
     */
    public function get(string $key): string|null
    {
        if (isset($_SERVER[$key])) {
            return $_SERVER[$key];
        }

        return null;
    }

    public function set(string $key, string $value): string
    {
        $_SERVER[$key] = $value;

        return $_SERVER[$key];
    }

    public function has(string $key): bool
    {
        return isset($_SERVER[$key]) ?? false;
    }
}
