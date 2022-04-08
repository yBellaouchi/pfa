<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
class Patient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $Prenom;

    #[ORM\Column(type: 'string', length: 255)]
    private $Cin;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $Telephone;


    #[ORM\OneToMany(mappedBy: 'Patient', targetEntity: RendezVous::class)]
    private $ListRendezVous;

    #[ORM\OneToMany(mappedBy: 'Patient', targetEntity: Observation::class)]
    private $observations;

    public function __construct()
    {
        $this->ListRendezVous = new ArrayCollection();
        $this->observations = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->Nom;
    }

    public function setNom(string $Nom)
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom()
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom)
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getCin()
    {
        return $this->Cin;
    }

    public function setCin(string $Cin)
    {
        $this->Cin = $Cin;

        return $this;
    }

    public function getTelephone()
    {
        return $this->Telephone;
    }

    public function setTelephone(string $Telephone)
    {
        $this->Telephone = $Telephone;

        return $this;
    }



    /**
     * @return Collection<int, RendezVous>
     */
    public function getListRendezVous(): Collection
    {
        return $this->ListRendezVous;
    }

    public function addListRendezVou(RendezVous $listRendezVou): self
    {
        if (!$this->ListRendezVous->contains($listRendezVou)) {
            $this->ListRendezVous[] = $listRendezVou;
            $listRendezVou->setPatient($this);
        }

        return $this;
    }

    public function removeListRendezVou(RendezVous $listRendezVou): self
    {
        if ($this->ListRendezVous->removeElement($listRendezVou)) {
            // set the owning side to null (unless already changed)
            if ($listRendezVou->getPatient() === $this) {
                $listRendezVou->setPatient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Observation>
     */
    public function getObservations()
    {
        return $this->observations;
    }

    public function addObservation(Observation $observation)
    {
        if (!$this->observations->contains($observation)) {
            $this->observations[] = $observation;
            $observation->setPatient($this);
        }

        return $this;
    }

    public function removeObservation(Observation $observation)
    {
        if ($this->observations->removeElement($observation)) {
            // set the owning side to null (unless already changed)
            if ($observation->getPatient() === $this) {
                $observation->setPatient(null);
            }
        }

        return $this;
    }
}
