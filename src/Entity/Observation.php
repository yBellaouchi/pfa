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

    #[ORM\Column(type: 'string', length: 255)]
    private $Description;

    #[ORM\Column(type: 'datetime')]
    private $Date;

    #[ORM\ManyToOne(targetEntity: Doctor::class, inversedBy: 'observations')]
    private $Doctor;

    #[ORM\ManyToOne(targetEntity: Patient::class, inversedBy: 'observations')]
    private $Patient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getDoctor(): ?Doctor
    {
        return $this->Doctor;
    }

    public function setDoctor(?Doctor $Doctor): self
    {
        $this->Doctor = $Doctor;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->Patient;
    }

    public function setPatient(?Patient $Patient): self
    {
        $this->Patient = $Patient;

        return $this;
    }
}
