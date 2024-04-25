<?php

namespace App\Entity;

use App\Repository\SeccionEventoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeccionEventoRepository::class)]
class SeccionEvento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'Secciones')]
    private ?Secciones $id_seccion = null;

    #[ORM\Column]
    private ?float $Precio = null;

    #[ORM\OneToMany(targetEntity: Entrada::class, mappedBy: 'id_SeccionEvento')]
    private Collection $seccionesEventos;

    #[ORM\ManyToOne(inversedBy: 'seccionesEventos')]
    private ?DeportesEventos $id_deporteEvento = null;

    public function __construct()
    {
        $this->seccionesEventos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSeccion(): ?Secciones
    {
        return $this->id_seccion;
    }

    public function setIdSeccion(?Secciones $id_seccion): static
    {
        $this->id_seccion = $id_seccion;

        return $this;
    }

    

    public function getPrecio(): ?float
    {
        return $this->Precio;
    }

    public function setPrecio(float $Precio): static
    {
        $this->Precio = $Precio;

        return $this;
    }

    /**
     * @return Collection<int, Entrada>
     */
    public function getSeccionesEventos(): Collection
    {
        return $this->seccionesEventos;
    }

    public function addSeccionesEvento(Entrada $seccionesEvento): static
    {
        if (!$this->seccionesEventos->contains($seccionesEvento)) {
            $this->seccionesEventos->add($seccionesEvento);
            $seccionesEvento->setIdSeccionEvento($this);
        }

        return $this;
    }

    public function removeSeccionesEvento(Entrada $seccionesEvento): static
    {
        if ($this->seccionesEventos->removeElement($seccionesEvento)) {
            // set the owning side to null (unless already changed)
            if ($seccionesEvento->getIdSeccionEvento() === $this) {
                $seccionesEvento->setIdSeccionEvento(null);
            }
        }

        return $this;
    }

    public function getIdDeporteEvento(): ?DeportesEventos
    {
        return $this->id_deporteEvento;
    }

    public function setIdDeporteEvento(?DeportesEventos $id_deporteEvento): static
    {
        $this->id_deporteEvento = $id_deporteEvento;

        return $this;
    }
}
