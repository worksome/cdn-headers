<?php

declare(strict_types=1);

use Worksome\CdnHeaders\Providers\FakeProvider;

beforeEach(function () {
    $this->country = 'GB';
    $this->config = [
        'default-country' => $this->country,
    ];
});

it('should get null as a default country code if no config is present', function () {
    $provider = new FakeProvider([]);

    expect($provider->getCountryCode())->toBe(null);
    expect($provider->hasCountryCode())->toBeFalse();
});

it('should get config default country code if present', function () {
    $provider = new FakeProvider($this->config);

    expect($provider->getCountryCode())->toBe($this->country);
    expect($provider->hasCountryCode())->toBeTrue();
});

it('should get null as a default connecting ip', function () {
    $provider = new FakeProvider($this->config);
    expect($provider->getConnectingIp())->toBe(null);
});

it('should get null as a default ray', function () {
    $provider = new FakeProvider($this->config);
    expect($provider->getTraceId())->toBe(null);
});
