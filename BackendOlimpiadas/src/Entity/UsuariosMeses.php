<?php

namespace App\Entity;

use App\Repository\UsuariosMesesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuariosMesesRepository::class)]
class UsuariosMeses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $mes1 = null;

    #[ORM\Column]
    private ?int $mes2 = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Usuario $idUsuario = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMes1(): ?int
    {
        return $this->mes1;
    }

    public function setMes1(int $mes1): static
    {
        $this->mes1 = $mes1;

        return $this;
    }

    public function getMes2(): ?int
    {
        return $this->mes2;
    }

    public function setMes2(int $mes2): static
    {
        $this->mes2 = $mes2;

        return $this;
    }

    public function getIdUsuario(): ?Usuario
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(?Usuario $idUsuario): static
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }
}
