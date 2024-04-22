<?php

namespace App\Entity;

use App\Repository\EstadioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstadioRepository::class)]
class Estadio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NombreEstadio = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreEstadio(): ?string
    {
        return $this->NombreEstadio;
    }

    public function setNombreEstadio(string $NombreEstadio): static
    {
        $this->NombreEstadio = $NombreEstadio;

        return $this;
    }
}
