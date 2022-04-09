<?php

namespace App\Entity;

use App\Repository\EtageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtageRepository::class)]
class Etage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $numéro;

    #[ORM\OneToMany(mappedBy: 'etage', targetEntity: Chambre::class)]
    private $chambres;

    public function __construct()
    {
        $this->chambres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNuméro(): ?int
    {
        return $this->numéro;
    }

    public function setNuméro(int $numéro): self
    {
        $this->numéro = $numéro;

        return $this;
    }

    /**
     * @return Collection<int, Chambre>
     */
    public function getChambres(): Collection
    {
        return $this->chambres;
    }

    public function addChambre(Chambre $chambre): self
    {
        if (!$this->chambres->contains($chambre)) {
            $this->chambres[] = $chambre;
            $chambre->setEtage($this);
        }

        return $this;
    }

    public function removeChambre(Chambre $chambre): self
    {
        if ($this->chambres->removeElement($chambre)) {
            // set the owning side to null (unless already changed)
            if ($chambre->getEtage() === $this) {
                $chambre->setEtage(null);
            }
        }

        return $this;
    }
}
