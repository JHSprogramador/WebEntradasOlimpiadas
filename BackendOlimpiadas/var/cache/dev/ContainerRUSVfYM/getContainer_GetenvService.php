<?php

<<<<<<<< HEAD:BackendOlimpiadas/var/cache/dev/ContainerRUSVfYM/getContainer_GetenvService.php
namespace ContainerRUSVfYM;
========
namespace ContainerUFwgE1b;

>>>>>>>> d4c28e912e52caf526a829664115db5dc7736315:BackendOlimpiadas/var/cache/dev/ContainerUFwgE1b/getContainer_GetenvService.php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getContainer_GetenvService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'container.getenv' shared service.
     *
     * @return \Closure
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['container.getenv'] = $container->getEnv(...);
    }
}