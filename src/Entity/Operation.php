<?php

namespace App\Entity;

use App\Repository\OperationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Medecin;
#[ORM\Entity(repositoryClass: OperationRepository::class)]
class Operation extends RendezVous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $TypeOperation;

    #[ORM\OneToMany(mappedBy: 'operation', targetEntity: chambre::class)]
    private $chambre;

    public function __construct()
    {
        $this->chambre = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTypeOperation()
    {
        return $this->TypeOperation;
    }
    public function setTypeOperation(string $TypeOperation)
    {
        $this->TypeOperation = $TypeOperation;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->RendezVou->Date;
    }

    /**
     * @param mixed $Date
     */
    public function setDate($Date)
    {
        $this->RendezVou->Date= $Date;
    }

    /**
     * @return mixed
     */
    public function getMedecin()
    {
        return $this->RendezVous->Medecin;
    }

    /**
     * @param mixed $Medecin
     */
    public function setMedecin($Medecin)
    {
        $this->RendezVous->Medecin = $Medecin;
    }

    /**
     * @return mixed
     */
    public function getPatient()
    {
        return $this->RendezVous->Patient;
    }

    /**
     * @param mixed $Patient
     */
    public function setPatient($Patient)
    {
        $this->RendezVous->Patient= $Patient;
    }

    /**
     * @return Collection<int, chambre>
     */
    public function getChambre(): Collection
    {
        return $this->chambre;
    }

    public function addChambre(chambre $chambre): self
    {
        if (!$this->chambre->contains($chambre)) {
            $this->chambre[] = $chambre;
            $chambre->setOperation($this);
        }

        return $this;
    }

    public function removeChambre(chambre $chambre): self
    {
        if ($this->chambre->removeElement($chambre)) {
            // set the owning side to null (unless already changed)
            if ($chambre->getOperation() === $this) {
                $chambre->setOperation(null);
            }
        }

        return $this;
    }


}
