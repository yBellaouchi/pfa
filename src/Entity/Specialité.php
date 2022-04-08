<?php

namespace App\Entity;

use App\Repository\SpecialitéRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecialitéRepository::class)]
class Specialité
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Nom;

    #[ORM\OneToMany(mappedBy: 'specialité', targetEntity: Medecin::class)]
    private $Medecin;

    public function __construct()
    {
        $this->Medecin = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    /**
     * @return Collection<int, Medecin>
     */
    public function getMedecin(): Collection
    {
        return $this->Medecin;
    }

    public function addMedecin(Medecin $medecin): self
    {
        if (!$this->Medecin->contains($medecin)) {
            $this->Medecin[] = $medecin;
            $medecin->setSpecialité($this);
        }

        return $this;
    }

    public function removeMedecin(Medecin $medecin): self
    {
        if ($this->Medecin->removeElement($medecin)) {
            // set the owning side to null (unless already changed)
            if ($medecin->getSpecialité() === $this) {
                $medecin->setSpecialité(null);
            }
        }

        return $this;
    }
}
