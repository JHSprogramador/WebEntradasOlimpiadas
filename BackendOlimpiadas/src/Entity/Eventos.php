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

    #[ORM\OneToMany(targetEntity: DeportesEventos::class, mappedBy: 'id_evento')]
    private Collection $eventos;





    public function __construct()
    {
        $this->eventos = new ArrayCollection();
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

    /**
     * @return Collection<int, DeportesEventos>
     */
    public function getEventos(): Collection
    {
        return $this->eventos;
    }

    public function addEvento(DeportesEventos $evento): static
    {
        if (!$this->eventos->contains($evento)) {
            $this->eventos->add($evento);
            $evento->setIdEvento($this);
        }

        return $this;
    }

    public function removeEvento(DeportesEventos $evento): static
    {
        if ($this->eventos->removeElement($evento)) {
            // set the owning side to null (unless already changed)
            if ($evento->getIdEvento() === $this) {
                $evento->setIdEvento(null);
            }
        }

        return $this;
    }

   

    


}
