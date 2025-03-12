<?php

declare(strict_types=1);

namespace Worksome\CdnHeaders;

use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Worksome\CdnHeaders\Contracts\CdnHeadersProvider;

class CdnHeadersServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function boot(): void
    {
        $this->app->get(CdnHeadersProvider::class)->boot();
    }

    public function register(): void
    {
        $this->app->singleton(
            CdnHeadersManager::class,
            static fn (Container $container) => new CdnHeadersManager($container)
        );

        $this->app->singleton(
            CdnHeadersProvider::class,
            static fn (Container $app) => $app->get(CdnHeadersManager::class)->driver()
        );
    }

    public function provides(): array
    {
        return [CdnHeadersProvider::class, CdnHeadersManager::class];
    }
}
