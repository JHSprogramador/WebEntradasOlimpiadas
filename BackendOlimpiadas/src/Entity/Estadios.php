<?php

namespace App\Entity;

use App\Repository\EstadiosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstadiosRepository::class)]
class Estadios
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombreEstadio = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreEstadio(): ?string
    {
        return $this->nombreEstadio;
    }

    public function setNombreEstadio(string $nombreEstadio): static
    {
        $this->nombreEstadio = $nombreEstadio;

        return $this;
    }
}
