<?php

namespace Worksome\CdnHeaders;

use Illuminate\Support\Manager;
use Worksome\CdnHeaders\Contracts\CdnHeadersProvider;
use Worksome\CdnHeaders\Providers\CloudFlare\CloudFlareProvider;
use Worksome\CdnHeaders\Providers\FakeProvider;

class CdnHeadersManager extends Manager
{
    public function createCloudFlareDriver(): CdnHeadersProvider
    {
        return new CloudFlareProvider(
            $this->config->get('cdn-headers') ?? [],
            $this->container->get(ServerHeadersRepository::class)
        );
    }

    public function createFakeDriver(): CdnHeadersProvider
    {
        return new FakeProvider($this->config->get('cdn-headers') ?? []);
    }

    public function getDefaultDriver(): string
    {
        return $this->config->get('cdn-headers.default-provider') ?? 'cloudflare';
    }

    public function provider(string $driver): CdnHeadersProvider
    {
        return $this->driver($driver);
    }
}
