<?php

namespace NasimTelecom\Simotel\Tests;

use NasimTelecom\Simotel\Simotel;

class IvrApiTest extends TestCase
{
    private $config = [
        'ivrApi' => [
            'apps' => [
                'fooApp' => FooIvrApi::class,
            ],
        ],
    ];

    public function testResponse()
    {
        $appData = [
            'app_name' => 'fooApp',
            'data'     => '1',
        ];

        $simotel = new Simotel($this->config);
        $response = $simotel->ivrApiCall($appData);

        $this->assertJson($response->toJson());

        $response = $response->toArray();
        $this->assertIsArray($response);
        $this->assertArrayHasKey('case', $response);
        $this->assertEquals('route 1', $response["case"]);
        $this->assertArrayHasKey('ok', $response);
    }
}

class FooIvrApi
{
    public function fooApp()
    {
        return "route 1";
    }
}

