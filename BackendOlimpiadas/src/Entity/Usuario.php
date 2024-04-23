<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $idAuth0 = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Entrada::class, mappedBy: 'id_usuario')]
    private Collection $entradas;

    public function __construct()
    {
        $this->entradas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAuth0(): ?string
    {
        return $this->idAuth0;
    }

    public function setIdAuth0(string $idAuth0): static
    {
        $this->idAuth0 = $idAuth0;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Entrada>
     */
    public function getEntradas(): Collection
    {
        return $this->entradas;
    }

    public function addEntrada(Entrada $entrada): static
    {
        if (!$this->entradas->contains($entrada)) {
            $this->entradas->add($entrada);
            $entrada->setIdUsuario($this);
        }

        return $this;
    }

    public function removeEntrada(Entrada $entrada): static
    {
        if ($this->entradas->removeElement($entrada)) {
            // set the owning side to null (unless already changed)
            if ($entrada->getIdUsuario() === $this) {
                $entrada->setIdUsuario(null);
            }
        }

        return $this;
    }
}
