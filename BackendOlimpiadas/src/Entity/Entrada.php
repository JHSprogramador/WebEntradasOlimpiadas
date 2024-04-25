<?php

namespace App\Entity;

use App\Repository\EntradaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntradaRepository::class)]
class Entrada
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'entradas')]
    private ?Usuario $id_usuario = null;

    #[ORM\ManyToOne(inversedBy: 'SeccionesEventos')]
    private ?SeccionEvento $id_seccionEvento = null;

    #[ORM\ManyToOne]
    private ?Transaxxiones $id_transaccion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUsuario(): ?Usuario
    {
        return $this->id_usuario;
    }

    public function setIdUsuario(?Usuario $id_usuario): static
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    public function getIdSeccionEvento(): ?SeccionEvento
    {
        return $this->id_seccionEvento;
    }

    public function setIdSeccionEvento(?SeccionEvento $id_seccionEvento): static
    {
        $this->id_seccionEvento = $id_seccionEvento;

        return $this;
    }

    public function getIdTransaccion(): ?Transaxxiones
    {
        return $this->id_transaccion;
    }

    public function setIdTransaccion(?Transaxxiones $id_transaccion): static
    {
        $this->id_transaccion = $id_transaccion;

        return $this;
    }
}
