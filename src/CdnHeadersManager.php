<?php

namespace Worksome\CdnHeaders;

use Illuminate\Support\Manager;
use JetBrains\PhpStorm\Pure;
use Worksome\CdnHeaders\CloudFlare\CloudFlareProvider;
use Worksome\CdnHeaders\Contracts\CdnHeadersProvider as CdnHeadersProviderContract;

class CdnHeadersManager extends Manager
{
    #[Pure]
    public function createCloudFlareDriver(): CloudFlareProvider
    {
        return new CloudFlareProvider(
            $this->container->get(ServerHeadersRepository::class)
        );
    }

    #[Pure]
    public function getDefaultDriver(): string
    {
        return 'cloudflare';
    }

    public function provider(string $driver): CdnHeadersProviderContract
    {
        return $this->driver($driver);
    }
}
