<?php

namespace Worksome\CdnHeaders\CloudFlare;

use Worksome\CdnHeaders\Contracts\CdnHeadersProvider;
use Worksome\CdnHeaders\ServerHeadersRepository;

class CloudFlareProvider implements CdnHeadersProvider
{
    public function __construct(
        private ServerHeadersRepository $serverHeaders
    ) {
    }

    public function getCountryCode(): ?string
    {
        return $this->serverHeaders->get('HTTP_CF_IPCOUNTRY');
    }

    public function hasCountryCode(): bool
    {
        return (bool) $this->getCountryCode();
    }

    public function getConnectingIp(): ?string
    {
        return $this->serverHeaders->get('HTTP_CF_CONNECTING_IP');
    }

    /**
     * https://support.cloudflare.com/hc/en-us/articles/203118044-What-is-the-CF-RAY-header-#h_f7a7396f-ec41-4c52-abf5-a110cadaca7c
     *
     * @return non-empty-string|null
     */
    public function getTraceId(): ?string
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
