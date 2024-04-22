<?php

namespace App\Entity;

use App\Repository\EventoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventoRepository::class)]
class Evento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombreEvento = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreEvento(): ?string
    {
        return $this->nombreEvento;
    }

    public function setNombreEvento(string $nombreEvento): static
    {
        $this->nombreEvento = $nombreEvento;

        return $this;
    }
}
