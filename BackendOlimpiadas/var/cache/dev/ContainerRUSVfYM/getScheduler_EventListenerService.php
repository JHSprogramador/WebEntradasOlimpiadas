<?php

<<<<<<<< HEAD:BackendOlimpiadas/var/cache/dev/ContainerRUSVfYM/getScheduler_EventListenerService.php
namespace ContainerRUSVfYM;
========
namespace ContainerUFwgE1b;

>>>>>>>> d4c28e912e52caf526a829664115db5dc7736315:BackendOlimpiadas/var/cache/dev/ContainerUFwgE1b/getScheduler_EventListenerService.php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getScheduler_EventListenerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'scheduler.event_listener' shared service.
     *
     * @return \Symfony\Component\Scheduler\EventListener\DispatchSchedulerEventListener
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'symfony'.\DIRECTORY_SEPARATOR.'scheduler'.\DIRECTORY_SEPARATOR.'EventListener'.\DIRECTORY_SEPARATOR.'DispatchSchedulerEventListener.php';

        $a = ($container->services['event_dispatcher'] ?? self::getEventDispatcherService($container));

        if (isset($container->privates['scheduler.event_listener'])) {
            return $container->privates['scheduler.event_listener'];
        }

        return $container->privates['scheduler.event_listener'] = new \Symfony\Component\Scheduler\EventListener\DispatchSchedulerEventListener(($container->privates['.service_locator.Xbsa8iG'] ??= new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [], [])), $a);
    }
}