<?php

namespace App\Entity;

use App\Repository\ObservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObservationRepository::class)]
class Observation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $Date;

    #[ORM\Column(type: 'string', length: 255)]
    private $Description;

    #[ORM\ManyToOne(targetEntity: Medecin::class, inversedBy: 'observations')]
    #[ORM\JoinColumn(nullable: false)]
    private $Medecin;

    #[ORM\ManyToOne(targetEntity: Patient::class, inversedBy: 'observations')]
    #[ORM\JoinColumn(nullable: false)]
    private $Patient;

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

    public function getDescription()
    {
        return $this->Description;
    }

    public function setDescription(string $Description)
    {
        $this->Description = $Description;

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
