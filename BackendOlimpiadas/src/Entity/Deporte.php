<?php

namespace App\Entity;

use App\Repository\DeporteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeporteRepository::class)]
class Deporte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NombreDeporte = null;

    #[ORM\Column]
    private ?int $periodo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreDeporte(): ?string
    {
        return $this->NombreDeporte;
    }

    public function setNombreDeporte(string $NombreDeporte): static
    {
        $this->NombreDeporte = $NombreDeporte;

        return $this;
    }

    public function getPeriodo(): ?int
    {
        return $this->periodo;
    }

    public function setPeriodo(int $periodo): static
    {
        $this->periodo = $periodo;

        return $this;
    }
}
