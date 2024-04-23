<?php

namespace App\Entity;

use App\Repository\EventosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventosRepository::class)]
class Eventos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombreEvento = null;

    #[ORM\Column]
    private ?int $periodo = null;

    #[ORM\ManyToMany(targetEntity: Deportes::class, inversedBy: 'eventos')]
    private Collection $id_deporte;

    #[ORM\OneToMany(targetEntity: SeccionEvento::class, mappedBy: 'id_evento')]
    private Collection $Eventos;

    public function __construct()
    {
        $this->id_deporte = new ArrayCollection();
        $this->Eventos = new ArrayCollection();
    }

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

    public function getPeriodo(): ?int
    {
        return $this->periodo;
    }

    public function setPeriodo(int $periodo): static
    {
        $this->periodo = $periodo;

        return $this;
    }

    /**
     * @return Collection<int, Deportes>
     */
    public function getIdDeporte(): Collection
    {
        return $this->id_deporte;
    }

    public function addIdDeporte(Deportes $idDeporte): static
    {
        if (!$this->id_deporte->contains($idDeporte)) {
            $this->id_deporte->add($idDeporte);
        }

        return $this;
    }

    public function removeIdDeporte(Deportes $idDeporte): static
    {
        $this->id_deporte->removeElement($idDeporte);

        return $this;
    }

    /**
     * @return Collection<int, SeccionEvento>
     */
    public function getEventos(): Collection
    {
        return $this->Eventos;
    }

    public function addEvento(SeccionEvento $evento): static
    {
        if (!$this->Eventos->contains($evento)) {
            $this->Eventos->add($evento);
            $evento->setIdEvento($this);
        }

        return $this;
    }

    public function removeEvento(SeccionEvento $evento): static
    {
        if ($this->Eventos->removeElement($evento)) {
            // set the owning side to null (unless already changed)
            if ($evento->getIdEvento() === $this) {
                $evento->setIdEvento(null);
            }
        }

        return $this;
    }
}
