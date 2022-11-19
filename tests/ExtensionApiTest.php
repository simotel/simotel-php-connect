<?php

namespace Simotel\Tests;

use Simotel\Simotel;

class ExtensionApiTest extends TestCase
{
    private $config = [
        'extensionApi' => [
            'apps' => [
                '*' => FooExtensionApi::class,
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
        $response = $simotel->extensionApi($appData);

        $this->assertJson($response->toJson());

        $response = $response->toArray();
        $this->assertIsArray($response);
        $this->assertArrayHasKey('extension', $response);
        $this->assertEquals('999', $response["extension"]);
        $this->assertArrayHasKey('ok', $response);
    }

}

class FooExtensionApi
{
    public function fooApp()
    {
        return "999";
    }
}

