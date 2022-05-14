<?php

namespace AbdulsalamIshaq\Sendbox\Tests;

use GuzzleHttp\Client as Guzzle;
use AbdulsalamIshaq\Sendbox\Client;
use AbdulsalamIshaq\Sendbox\Api\Shipment;
use AbdulsalamIshaq\Sendbox\Api\Payment;

it('test class handler', function () {
    $client = new Client('wertyuiopasdfghjklervbnmeryuio');
    $this->assertInstanceOf(Client::class, $client);
    $this->assertInstanceOf(Shipment::class, $client->shipment);
    $this->assertInstanceOf(Payment::class, $client->payment);
});

it('test mass fill', function () {
    $client = new Client('wertyuiopasdfghjklervbnmeryuio');
    $client->fillOptions([
        'httpClient' => new Guzzle([
            // Base URI is used with relative requests
            'base_uri' => $client->baseUri(),
            // You can set any number of default request options.
            'timeout'  => 10.0,
        ]),
    ]);

    $this->assertInstanceOf(Guzzle::class, $client->getHttpClient());
});
