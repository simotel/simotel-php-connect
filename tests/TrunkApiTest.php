<?php

namespace NasimTelecom\Simotel\Tests;

use NasimTelecom\Simotel\Simotel;

class TrunkApiTest extends TestCase
{
    private $config = [
        'trunkApi' => [
            'apps' => [
                '*' => FooTrunkApi::class,
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
        $response = $simotel->trunkApiCall($appData);

        $this->assertJson($response->toJson());

        $response = $response->toArray();
        $this->assertIsArray($response);
        $this->assertArrayHasKey('trunk', $response);
        $this->assertEquals('999', $response["extension"]);
        $this->assertArrayHasKey('ok', $response);
    }

}

class FooTrunkApi
{
    public function fooApp()
    {
        return [
            "trunk"=>"test trunk",
            "extension"=>"999",
            "call_limit"=>"500",
        ];
    }
}

