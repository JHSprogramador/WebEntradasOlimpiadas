<?php

namespace App\Entity;

use App\Repository\DeportesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeportesRepository::class)]
class Deportes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombreDeporte = null;

    #[ORM\ManyToMany(targetEntity: Eventos::class, mappedBy: 'id_deporte')]
    private Collection $eventos;

    #[ORM\Column]
    private ?int $Periodo = null;

    #[ORM\OneToMany(targetEntity: DeportesEventos::class, mappedBy: 'id_deporte')]
    private Collection $deportes;

    public function __construct()
    {
        $this->eventos = new ArrayCollection();
        $this->deportes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreDeporte(): ?string
    {
        return $this->nombreDeporte;
    }

    public function setNombreDeporte(string $nombreDeporte): static
    {
        $this->nombreDeporte = $nombreDeporte;

        return $this;
    }

    /**
     * @return Collection<int, Eventos>
     */
    public function getEventos(): Collection
    {
        return $this->eventos;
    }

    public function addEvento(Eventos $evento): static
    {
        if (!$this->eventos->contains($evento)) {
            $this->eventos->add($evento);
            $evento->addIdDeporte($this);
        }

        return $this;
    }

    public function removeEvento(Eventos $evento): static
    {
        if ($this->eventos->removeElement($evento)) {
            $evento->removeIdDeporte($this);
        }

        return $this;
    }

    public function getPeriodo(): ?int
    {
        return $this->Periodo;
    }

    public function setPeriodo(int $Periodo): static
    {
        $this->Periodo = $Periodo;

        return $this;
    }

    /**
     * @return Collection<int, DeportesEventos>
     */
    public function getDeportes(): Collection
    {
        return $this->deportes;
    }

    public function addDeporte(DeportesEventos $deporte): static
    {
        if (!$this->deportes->contains($deporte)) {
            $this->deportes->add($deporte);
            $deporte->setIdDeporte($this);
        }

        return $this;
    }

    public function removeDeporte(DeportesEventos $deporte): static
    {
        if ($this->deportes->removeElement($deporte)) {
            // set the owning side to null (unless already changed)
            if ($deporte->getIdDeporte() === $this) {
                $deporte->setIdDeporte(null);
            }
        }

        return $this;
    }
}
