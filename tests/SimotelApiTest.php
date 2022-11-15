<?php

namespace NasimTelecom\Simotel\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use NasimTelecom\Simotel\Simotel;
use NasimTelecom\Simotel\SimotelApi\Parameters;

class SimotelApiTest extends TestCase
{
    private $simotel;

    public function __construct()
    {
        $this->simotel = new Simotel();
        parent::__construct();
    }


    public function testNewTest()
    {

        $simotel = new Simotel();

        $data = [
            "name"=>"hossein",
            "exten" => "yaghmaee"
        ];

        $client = $this->createHttpClient();
        $result = $simotel->connect("pbx/users/create", $data, $client);

        $this->assertTrue($result->isOk());
        $this->assertEquals("message", $result->getMessage());
        $this->assertEquals(["data"], $result->getData());
        $this->assertEquals(
            json_encode(['success' => 1, 'message' => 'message', 'data' => ['data']]),
            (string) $result
        );
       
    }

    public function createHttpClient()
    {
        $res = json_encode(['success' => 1, 'message' => 'message', 'data' => ['data']]);

        $mock = new MockHandler([
            new Response(200, [], $res),
        ]);

        $handlerStack = HandlerStack::create($mock);

        return new Client(['handler' => $handlerStack]);
    }
}
