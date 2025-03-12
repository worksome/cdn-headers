<?php

declare(strict_types=1);

namespace Worksome\CdnHeaders\Providers;

use Worksome\CdnHeaders\Contracts\CdnHeadersProvider;

class FakeProvider implements CdnHeadersProvider
{
    public function __construct(private array $config)
    {
    }

    public function getCountryCode(): string|null
    {
        return $this->config['default-country'] ?? null;
    }

    public function hasCountryCode(): bool
    {
        return (bool) $this->getCountryCode();
    }

    public function getConnectingIp(): string|null
    {
        return null;
    }

    public function getTraceId(): string|null
    {
        return null;
    }

    public function boot(): void
    {
    }
}
