<?php

<<<<<<<< HEAD:BackendOlimpiadas/var/cache/dev/ContainerRUSVfYM/get_Console_Command_CachePoolList_LazyService.php
namespace ContainerRUSVfYM;
========
namespace ContainerUFwgE1b;

>>>>>>>> d4c28e912e52caf526a829664115db5dc7736315:BackendOlimpiadas/var/cache/dev/ContainerUFwgE1b/get_Console_Command_CachePoolList_LazyService.php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_Console_Command_CachePoolList_LazyService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.console.command.cache_pool_list.lazy' shared service.
     *
     * @return \Symfony\Component\Console\Command\LazyCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'symfony'.\DIRECTORY_SEPARATOR.'console'.\DIRECTORY_SEPARATOR.'Command'.\DIRECTORY_SEPARATOR.'Command.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'symfony'.\DIRECTORY_SEPARATOR.'console'.\DIRECTORY_SEPARATOR.'Command'.\DIRECTORY_SEPARATOR.'LazyCommand.php';

        return $container->privates['.console.command.cache_pool_list.lazy'] = new \Symfony\Component\Console\Command\LazyCommand('cache:pool:list', [], 'List available cache pools', false, #[\Closure(name: 'console.command.cache_pool_list', class: 'Symfony\\Bundle\\FrameworkBundle\\Command\\CachePoolListCommand')] fn (): \Symfony\Bundle\FrameworkBundle\Command\CachePoolListCommand => ($container->privates['console.command.cache_pool_list'] ?? $container->load('getConsole_Command_CachePoolListService')));
    }
}