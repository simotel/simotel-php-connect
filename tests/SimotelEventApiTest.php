<?php

namespace NasimTelecom\Simotel\Tests;

use NasimTelecom\Simotel\Simotel;

class SimotelEventApiTest extends TestCase
{
    public function testUnknownEventName()
    {
        $this->expectExceptionMessage("Unknown Event");

        $simotel = new Simotel();
        $simotel->eventApi()->dispatch('WrongEventName', []);

    }

    public function testResolveEvent()
    {
        $simotel = new Simotel();

        $simotel->eventApi()->addListener('Cdr', function ($data) {
            $this->assertEquals($data['data1'], 'testData1');
        });

        // pass data to Cdr listener
        $_REQUEST = [
            'event_name' => 'Cdr',
            'data1' => 'testData1',
        ];

        $simotel->eventApi()->resolve();

    }

    public function testDispatchEvent()
    {
        $simotel = new Simotel();

        $simotel->eventApi()->addListener('IncomingCall', function ($data) {
            $this->assertEquals($data['data1'], 'testData1');
        });
        $simotel->eventApi()->addListener('IncomingCall', function ($data) {
            $this->assertNotEquals($data['data1'], 'Wrong Data');
        });

        // pass data to Cdr listener
        $data = [
            'data1' => 'testData1',
        ];

        $simotel->eventApi()->dispatch("IncomingCall",$data);

    }
}
