<?php

declare(strict_types=1);

use Worksome\CdnHeaders\Providers\CloudFlare\CloudFlareProvider;
use Worksome\CdnHeaders\ServerHeadersRepository;

beforeEach(function () {
    $this->country = 'GB';
    $this->mock = Mockery::mock(ServerHeadersRepository::class);
    $this->config = [
        'default-country' => $this->country,
    ];
});

it('should get null as a default country code if no config is present', function () {
    $this->mock->shouldReceive('get')->andReturn(null);
    $provider = new CloudFlareProvider([], $this->mock);

    expect($provider->getCountryCode())->toBe(null);
    expect($provider->hasCountryCode())->toBeFalse();
});

it('should get config default country code if present', function () {
    $this->mock->shouldReceive('get')->andReturn(null);
    $provider = new CloudFlareProvider($this->config, $this->mock);

    expect($provider->getCountryCode())->toBe($this->country);
    expect($provider->hasCountryCode())->toBeTrue();
});

it('should return a correct country code if server header present', function () {
    $this->mock->shouldReceive('get')->andReturn('US');
    $provider = new CloudFlareProvider($this->config, $this->mock);

    expect($provider->getCountryCode())->toBe('US');
    expect($provider->hasCountryCode())->toBeTrue();
});

it('should get null as a default connecting ip', function () {
    $this->mock->shouldReceive('get')->andReturn(null);
    $provider = new CloudFlareProvider($this->config, $this->mock);
    expect($provider->getConnectingIp())->toBe(null);
});

it('should return an ip', function () {
    $this->mock->shouldReceive('get')->andReturn('127.0.0.1');
    $provider = new CloudFlareProvider($this->config, $this->mock);
    expect($provider->getConnectingIp())->toBe('127.0.0.1');
});

it('should get null as a default ray', function () {
    $this->mock->shouldReceive('get')->andReturn(null);
    $provider = new CloudFlareProvider($this->config, $this->mock);
    expect($provider->getTraceId())->toBe(null);
});

it('should return ray', function () {
    $this->mock->shouldReceive('get')->andReturn('CF12345679');
    $provider = new CloudFlareProvider($this->config, $this->mock);
    expect($provider->getTraceId())->toBe('CF12345679');
});
