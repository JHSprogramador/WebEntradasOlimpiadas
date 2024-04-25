<?php
namespace EventDispatchers\Listeners;
use Symfony\Contracts\EventDispatcher\Event;
use EventDispatchers\Events\DemoEvent;
class DemoListener
{
    public function onDemoEvent(DemoEvent $event)
    {
      // fetch event information here 
      echo "DemoListener is called!\n";
      echo "The value of the foo is: ".$event->getFoo()."\n";
    }
}