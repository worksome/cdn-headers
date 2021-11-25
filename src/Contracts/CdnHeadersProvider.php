<?php

namespace Worksome\CdnHeaders\Contracts;

interface CdnHeadersProvider
{
    /**
     * Visitor country code
     * returns CCA2 format (uppercase)
     *
     * @return non-empty-string|null
     */
    public function getCountryCode(): ?string;

    public function hasCountryCode(): bool;

    /**
     * Real visitor IP address
     *
     * @return non-empty-string|null
     */
    public function getConnectingIp(): ?string;

    public function getTraceId(): ?string;

    /**
     * Anything required to be loaded in the boot
     * method of the service provider
     */
    public function boot(): void;
}
