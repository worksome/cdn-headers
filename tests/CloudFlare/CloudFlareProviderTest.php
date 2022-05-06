<?php

use Worksome\CdnHeaders\CloudFlare\CloudFlareProvider;
use Worksome\CdnHeaders\ServerHeadersRepository;

beforeEach(fn () => $this->mock = Mockery::mock(ServerHeadersRepository::class));

it('should get null as a default country code', function () {
    $this->mock->shouldReceive('get')->andReturn(null);
    $provider = new CloudFlareProvider($this->mock);

    expect($provider->getCountryCode())->toBe(null);
    expect($provider->hasCountryCode())->toBeFalse();
});

it('should return a correct country code if server header present', function () {
    $this->mock->shouldReceive('get')->andReturn('US');
    $provider = new CloudFlareProvider($this->mock);

    expect($provider->getCountryCode())->toBe('US');
    expect($provider->hasCountryCode())->toBeTrue();
});

it('should get null as a default connecting ip', function () {
    $this->mock->shouldReceive('get')->andReturn(null);
    $provider = new CloudFlareProvider($this->mock);
    expect($provider->getConnectingIp())->toBe(null);
});

it('should return an ip', function () {
    $this->mock->shouldReceive('get')->andReturn('127.0.0.1');
    $provider = new CloudFlareProvider($this->mock);
    expect($provider->getConnectingIp())->toBe('127.0.0.1');
});

it('should get null as a default ray', function () {
    $this->mock->shouldReceive('get')->andReturn(null);
    $provider = new CloudFlareProvider($this->mock);
    expect($provider->getTraceId())->toBe(null);
});

it('should return ray', function () {
    $this->mock->shouldReceive('get')->andReturn('CF12345679');
    $provider = new CloudFlareProvider($this->mock);
    expect($provider->getTraceId())->toBe('CF12345679');
});
