<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChambreRepository::class)]
class Chambre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $numéro;

    #[ORM\ManyToOne(targetEntity: etage::class, inversedBy: 'chambres')]
    private $etage;

    #[ORM\ManyToOne(targetEntity: Operation::class, inversedBy: 'chambre')]
    private $operation;

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

    public function getEtage(): ?etage
    {
        return $this->etage;
    }

    public function setEtage(?etage $etage): self
    {
        $this->etage = $etage;

        return $this;
    }

    public function getOperation(): ?Operation
    {
        return $this->operation;
    }

    public function setOperation(?Operation $operation): self
    {
        $this->operation = $operation;

        return $this;
    }
}
