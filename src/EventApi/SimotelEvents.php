<?php

namespace Simotel\EventApi;

trait SimotelEvents
{
    /**
     * Event registerar.
     *
     * @var EventEmitter
     */
    protected static $eventEmitter;

    /**
     * Add verification event listener.
     *
     * @param $event
     * @param callable $listener
     *
     * @return void
     */
    public static function addEventListener($event, callable $listener)
    {
        static::singletoneEventEmitter();

        static::$eventEmitter->addEventListener($event, $listener);
    }

    /**
     * Remove verification event listener.
     *
     * @param $event
     * @param callable|null $listener
     *
     * @return void
     */
    public static function removeEventListener($event, callable $listener = null)
    {
        static::singletoneEventEmitter();

        static::$eventEmitter->removeEventListener($event, $listener);
    }

    /**
     * Dispatch an event.
     *
     * @param string $event
     * @param $data
     *
     * @return void
     */
    protected function dispatchEvent(string $event, $data)
    {
        static::singletoneEventEmitter();

        static::$eventEmitter->dispatch($event, $data);
    }

    /**
     * Add an singletone event registerar.
     *
     * @return void
     */
    protected static function singletoneEventEmitter()
    {
        if (static::$eventEmitter instanceof EventEmitter) {
            return;
        }

        static::$eventEmitter = new EventEmitter();
    }
}
