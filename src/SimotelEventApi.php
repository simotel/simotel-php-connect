<?php

namespace Simotel;

use Simotel\EventApi\SimotelEvents;

class SimotelEventApi
{
    use SimotelEvents;

    /**
     * @param string $simotelEventName 
     * @param callable $callback
     */
    public function addListener($simotelEventName, callable $callback)
    {
        self::addEventListener($simotelEventName, $callback);
    }

    /**
     * @param string  $simotelEventName
     * @param array   $data
     * @throws \Exception
     */
    public function dispatch($simotelEventName, $data)
    {
        $events = [
            "Cdr", "NewState", "IncomingCall", "OutgoingCall", "Transfer", "ExtenAdded", "ExtenRemoved",
            "IncomingFax", "IncomingFax", "CdrQueue", "VoiceMail", "VoiceMailEmail", "Survey"
        ];

        if (!in_array($simotelEventName, $events))
            throw new \Exception("Unknown Event");

        self::dispatchEvent($simotelEventName, $data);
    }


    /**
     * @throws \Exception
     */
    public function resolve()
    {
        //find event name
        $simotelEventName = $_REQUEST["event_name"] ?? null;

        //dispatch event
        $this->dispatch($simotelEventName, $_REQUEST);

    }


}
