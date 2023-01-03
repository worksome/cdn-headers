<?php

namespace Worksome\CdnHeaders;

use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Worksome\CdnHeaders\Contracts\CdnHeadersProvider as CdnHeadersProviderContract;

class CdnHeadersServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function boot(): void
    {
        $this->app->get(CdnHeadersProviderContract::class)->boot();
    }

    public function register(): void
    {
        $this->app->singleton(
            CdnHeadersManager::class,
            static fn(Container $container) => new CdnHeadersManager($container)
        );

        $this->app->singleton(
            CdnHeadersProviderContract::class,
            static fn(Container $app) => $app->get(CdnHeadersManager::class)->driver()
        );
    }

    public function provides(): array
    {
        return [CdnHeadersProviderContract::class, CdnHeadersManager::class];
    }
}
