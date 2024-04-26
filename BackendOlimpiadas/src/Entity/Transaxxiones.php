<?php

namespace App\Entity;

use App\Repository\TransaxxionesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransaxxionesRepository::class)]
class Transaxxiones
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaTransaccion = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }


    public function getFechaTransaccion(): ?\DateTimeInterface
    {
        return $this->fechaTransaccion;
    }

    public function setFechaTransaccion(\DateTimeInterface $fechaTransaccion): static
    {
        $this->fechaTransaccion = $fechaTransaccion;

        return $this;
    }
}
