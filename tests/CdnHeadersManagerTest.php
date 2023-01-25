<?php

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Container\Container;
use Worksome\CdnHeaders\CdnHeadersManager;
use Worksome\CdnHeaders\ServerHeadersRepository;

beforeEach(function () {
    $this->createMocks = function ($config) {
        $this->mockContainer = Mockery::mock(Container::class);
        $this->mockConfig = Mockery::mock(Repository::class);
        $this->mockContainer->shouldReceive('make')->andReturn($this->mockConfig);
        $this->mockContainer->shouldReceive('get')->andReturn(new ServerHeadersRepository());
        $this->mockConfig->shouldReceive('get')
            ->with('cdn-headers.default-provider')
            ->andReturn($config['default-provider']);
        $this->mockConfig->shouldReceive('get')
            ->with('cdn-headers')
            ->andReturn($config);
    };
});

it('should return cloudflare as the default provider if no config param is present', function () {
    $this->createMocks->__invoke([
        'default-provider' => null,
    ]);
    $manager = new CdnHeadersManager($this->mockContainer);
    expect($manager->getDefaultDriver())->toBe('cloudflare');
});

it('should return fake as the provider if specified in config', function () {
    $this->createMocks->__invoke([
        'default-provider' => 'fake',
    ]);
    $manager = new CdnHeadersManager($this->mockContainer);
    expect($manager->getDefaultDriver())->toBe('fake');
});

it('should return cloudflare as the provider if specified in config', function () {
    $this->createMocks->__invoke([
        'default-provider' => 'cloudflare',
    ]);
    $manager = new CdnHeadersManager($this->mockContainer);
    expect($manager->getDefaultDriver())->toBe('cloudflare');
});
