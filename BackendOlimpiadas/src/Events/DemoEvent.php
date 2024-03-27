<?php

namespace EventDispatchers\Events;

use App\Entity\Usuario;
use App\Entity\UsuariosMeses;
use Symfony\Contracts\EventDispatcher\Event;
use think\contract\Arrayable;

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
    
    public function doSorteo(array $usuarios){
        if(date("d")==31 && date("m")==03 && date("Y")==2024){
            $turnos = 4;
            $len = count($usuarios);
            $count = $len / $turnos;
            $pos = 0;
            $numeros_repetidos = [];
            for ($i = 0; $i < $count; $i++) {
                    $numeros_unicos = range(1, 4);
                    shuffle($numeros_unicos);
                    $numeros_repetidos = array_merge($numeros_repetidos,$numeros_unicos);
            }
            $usuarioMeses = [];
            foreach ($usuarios as $usuario) {
                $nuevoUsuarioMeses = new UsuariosMeses;
                $nuevoUsuarioMeses->setIdUsuario($usuario->getId());
                $nuevoUsuarioMeses->setMes1($numeros_repetidos[$pos]);
                $nuevoUsuarioMeses->setMes2($numeros_repetidos[$pos]+$turnos);
                array_push($usuarioMeses,$nuevoUsuarioMeses);
                $pos++;
            }
            return $usuarioMeses;
        }
        
        
        

        
        
        
        
        
        

        
        
        
        
        
        
        
        
        

        
    }
}