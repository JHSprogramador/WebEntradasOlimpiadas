<?php

namespace EventDispatchers\Events;

use App\Entity\Usuario;
use App\Entity\UsuariosMeses;
use Symfony\Contracts\EventDispatcher\Event;

class DemoEvent extends Event
{
    public const NAME = 'demo.event';
    protected $foo;
    public function __construct()
    {
        $this->foo = 'bar';
    }
    public function getFoo()
    {
        return $this->foo;
    }
    public function doSorteo(Usuario $usuarios){
        $usuarioMeses = [];
        $usuarioMes = new UsuariosMeses;
        $len = count(array($usuarios));
        $maxUsersWeek = $len / 4;
        foreach ($usuarios as $usuario) {
        
        }
        return $usuarioMeses;

           }
}