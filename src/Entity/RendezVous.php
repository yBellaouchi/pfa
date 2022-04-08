<?php

namespace App\Entity;

use App\Repository\RendezVousRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RendezVousRepository::class)]
class RendezVous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'datetime')]
    protected $Date;

    #[ORM\ManyToOne(targetEntity: Medecin::class, inversedBy: 'ListRendezVous')]
    protected $Medecin;

    #[ORM\ManyToOne(targetEntity: Patient::class, inversedBy: 'ListRendezVous')]
    protected $Patient;

    public function getId()
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date)
    {
        $this->Date = $Date;

        return $this;
    }

    public function getMedecin()
    {
        return $this->Medecin;
    }

    public function setMedecin( $Medecin)
    {
        $this->Medecin = $Medecin;

        return $this;
    }

    public function getPatient()
    {
        return $this->Patient;
    }

    public function setPatient( $Patient)
    {
        $this->Patient = $Patient;

        return $this;
    }
}
