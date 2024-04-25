<?php

namespace App\Entity;

use App\Repository\DeportesEventosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeportesEventosRepository::class)]
class DeportesEventos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'deportes')]
    private ?Deportes $id_deporte = null;

    #[ORM\ManyToOne(inversedBy: 'eventos')]
    private ?Eventos $id_evento = null;

    #[ORM\OneToMany(targetEntity: SeccionEvento::class, mappedBy: 'id_deporteEvento')]
    private Collection $seccionesEventos;

    #[ORM\OneToMany(targetEntity: SeccionEvento::class, mappedBy: 'id_deporte_Evento')]
    private Collection $deportesEventos;

    public function __construct()
    {
        $this->seccionesEventos = new ArrayCollection();
        $this->deportesEventos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdDeporte(): ?Deportes
    {
        return $this->id_deporte;
    }

    public function setIdDeporte(?Deportes $id_deporte): static
    {
        $this->id_deporte = $id_deporte;

        return $this;
    }

    public function getIdEvento(): ?Eventos
    {
        return $this->id_evento;
    }

    public function setIdEvento(?Eventos $id_evento): static
    {
        $this->id_evento = $id_evento;

        return $this;
    }

    /**
     * @return Collection<int, SeccionEvento>
     */
    public function getSeccionesEventos(): Collection
    {
        return $this->seccionesEventos;
    }

    public function addSeccionesEvento(SeccionEvento $seccionesEvento): static
    {
        if (!$this->seccionesEventos->contains($seccionesEvento)) {
            $this->seccionesEventos->add($seccionesEvento);
            $seccionesEvento->setIdDeporteEvento($this);
        }

        return $this;
    }

    public function removeSeccionesEvento(SeccionEvento $seccionesEvento): static
    {
        if ($this->seccionesEventos->removeElement($seccionesEvento)) {
            // set the owning side to null (unless already changed)
            if ($seccionesEvento->getIdDeporteEvento() === $this) {
                $seccionesEvento->setIdDeporteEvento(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SeccionEvento>
     */
    public function getDeportesEventos(): Collection
    {
        return $this->deportesEventos;
    }

    public function addDeportesEvento(SeccionEvento $deportesEvento): static
    {
        if (!$this->deportesEventos->contains($deportesEvento)) {
            $this->deportesEventos->add($deportesEvento);
            $deportesEvento->setIdDeporteEvento($this);
        }

        return $this;
    }

    public function removeDeportesEvento(SeccionEvento $deportesEvento): static
    {
        if ($this->deportesEventos->removeElement($deportesEvento)) {
            // set the owning side to null (unless already changed)
            if ($deportesEvento->getIdDeporteEvento() === $this) {
                $deportesEvento->setIdDeporteEvento(null);
            }
        }

        return $this;
    }
}
