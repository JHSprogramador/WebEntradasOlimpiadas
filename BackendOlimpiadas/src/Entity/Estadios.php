<?php

namespace App\Entity;

use App\Repository\EstadiosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(targetEntity: Secciones::class, mappedBy: 'id_estadio')]
    private Collection $secciones;

    public function __construct()
    {
        $this->secciones = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Secciones>
     */
    public function getSecciones(): Collection
    {
        return $this->secciones;
    }

    public function addSeccione(Secciones $seccione): static
    {
        if (!$this->secciones->contains($seccione)) {
            $this->secciones->add($seccione);
            $seccione->setIdEstadio($this);
        }

        return $this;
    }

    public function removeSeccione(Secciones $seccione): static
    {
        if ($this->secciones->removeElement($seccione)) {
            // set the owning side to null (unless already changed)
            if ($seccione->getIdEstadio() === $this) {
                $seccione->setIdEstadio(null);
            }
        }

        return $this;
    }
}
