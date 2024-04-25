<?php

namespace App\Entity;

use App\Repository\SeccionesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeccionesRepository::class)]
class Secciones
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $aforo = null;

    #[ORM\Column(length: 255)]
    private ?string $nombreSeccion = null;

   

    #[ORM\OneToMany(targetEntity: SeccionEvento::class, mappedBy: 'id_seccion')]
    private Collection $secciones;

    #[ORM\ManyToOne(inversedBy: 'Secciones')]
    private ?Estadios $id_estadio = null;

    public function __construct()
    {
        $this->secciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAforo(): ?int
    {
        return $this->aforo;
    }

    public function setAforo(int $aforo): static
    {
        $this->aforo = $aforo;

        return $this;
    }

    public function getNombreSeccion(): ?string
    {
        return $this->nombreSeccion;
    }

    public function setNombreSeccion(string $nombreSeccion): static
    {
        $this->nombreSeccion = $nombreSeccion;

        return $this;
    }



    /**
     * @return Collection<int, SeccionEvento>
     */
    public function getSecciones(): Collection
    {
        return $this->secciones;
    }

    public function addSeccione(SeccionEvento $seccione): static
    {
        if (!$this->secciones->contains($seccione)) {
            $this->secciones->add($seccione);
            $seccione->setIdSeccion($this);
        }

        return $this;
    }

    public function removeSeccione(SeccionEvento $seccione): static
    {
        if ($this->secciones->removeElement($seccione)) {
            // set the owning side to null (unless already changed)
            if ($seccione->getIdSeccion() === $this) {
                $seccione->setIdSeccion(null);
            }
        }

        return $this;
    }

    public function getIdEstadio(): ?Estadios
    {
        return $this->id_estadio;
    }

    public function setIdEstadio(?Estadios $id_estadio): static
    {
        $this->id_estadio = $id_estadio;

        return $this;
    }
}
