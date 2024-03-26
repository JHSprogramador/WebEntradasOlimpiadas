<?php

namespace EventDispatchers\Events;
use Symfony\Contracts\EventDispatcher\Event;

class DemoEvent extends Event
{
    const NAME = 'demo.event';
    protected $foo;
    public function __construct()
    {
        $this->foo = 'bar';
    }
    public function getFoo()
    {
        return $this->foo;
    }
    public function doSorteo(){
            //Logiga del sorteo
            
    }
}