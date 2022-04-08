<?php

namespace App\Entity;

use App\Repository\MedecinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedecinRepository::class)]
class Medecin
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

    #[ORM\Column(type: 'string', length: 20)]
    private $Telephone;

    #[ORM\Column(type: 'string', length: 255)]
    private $Login;

    #[ORM\Column(type: 'string', length: 255)]
    private $Password;


    #[ORM\OneToMany(mappedBy: 'Medecin', targetEntity: RendezVous::class)]
    private $ListRendezVous;

    #[ORM\OneToMany(mappedBy: 'Medecin', targetEntity: Observation::class)]
    private $observations;

    #[ORM\ManyToOne(targetEntity: Specialité::class, inversedBy: 'Medecin')]
    #[ORM\JoinColumn(nullable: false)]
    private $specialité;

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

    public function getLogin()
    {
        return $this->Login;
    }

    public function setLogin(string $Login)
    {
        $this->Login = $Login;

        return $this;
    }

    public function getPassword()
    {
        return $this->Password;
    }

    public function setPassword(string $Password)
    {
        $this->Password = $Password;

        return $this;
    }



    /**
     * @return Collection<int, RendezVous>
     */
    public function getListRendezVous()
    {
        return $this->ListRendezVous;
    }

    public function addListRendezVou(RendezVous $listRendezVou)
    {
        if (!$this->ListRendezVous->contains($listRendezVou)) {
            $this->ListRendezVous[] = $listRendezVou;
            $listRendezVou->setMedecin($this);
        }

        return $this;
    }

    public function removeListRendezVou(RendezVous $listRendezVou)
    {
        if ($this->ListRendezVous->removeElement($listRendezVou)) {
            // set the owning side to null (unless already changed)
            if ($listRendezVou->getMedecin() === $this) {
                $listRendezVou->setMedecin(null);
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
            $observation->setMedecin($this);
        }

        return $this;
    }

    public function removeObservation(Observation $observation)
    {
        if ($this->observations->removeElement($observation)) {
            // set the owning side to null (unless already changed)
            if ($observation->getMedecin() === $this) {
                $observation->setMedecin(null);
            }
        }

        return $this;
    }

    public function getSpecialité()
    {
        return $this->specialité;
    }

    public function setSpecialité( $specialité)
    {
        $this->specialité = $specialité;

        return $this;
    }
}
