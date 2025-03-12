<?php

declare(strict_types=1);

namespace Worksome\CdnHeaders\Providers\CloudFlare;

use Worksome\CdnHeaders\Contracts\CdnHeadersProvider;
use Worksome\CdnHeaders\ServerHeadersRepository;

class CloudFlareProvider implements CdnHeadersProvider
{
    public function __construct(
        private array $config,
        private ServerHeadersRepository $serverHeaders,
    ) {
    }

    public function getCountryCode(): string|null
    {
        return $this->serverHeaders->get('HTTP_CF_IPCOUNTRY') ?? $this->config['default-country'] ?? null;
    }

    public function hasCountryCode(): bool
    {
        return (bool) $this->getCountryCode();
    }

    public function getConnectingIp(): string|null
    {
        return $this->serverHeaders->get('HTTP_CF_CONNECTING_IP');
    }

    /**
     * @link https://support.cloudflare.com/hc/en-us/articles/203118044-What-is-the-CF-RAY-header-#h_f7a7396f-ec41-4c52-abf5-a110cadaca7c
     *
     * @return non-empty-string|null
     */
    public function getTraceId(): string|null
    {
        return $this->serverHeaders->get('HTTP_CF_RAY');
    }

    public function boot(): void
    {
        if ($ip = $this->getConnectingIp()) {
            $this->serverHeaders->set('REMOTE_ADDR', $ip);
        }
    }
}
