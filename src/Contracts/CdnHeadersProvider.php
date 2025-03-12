<?php

declare(strict_types=1);

namespace Worksome\CdnHeaders\Contracts;

interface CdnHeadersProvider
{
    /**
     * Visitor country code
     * returns CCA2 format (uppercase)
     *
     * @return non-empty-string|null
     */
    public function getCountryCode(): string|null;

    public function hasCountryCode(): bool;

    /**
     * Real visitor IP address
     *
     * @return non-empty-string|null
     */
    public function getConnectingIp(): string|null;

    public function getTraceId(): string|null;

    /**
     * Anything required to be loaded in the boot
     * method of the service provider
     */
    public function boot(): void;
}
