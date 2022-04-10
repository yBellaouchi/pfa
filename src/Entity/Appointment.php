<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppointmentRepository::class)]
class Appointment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    Protected $id;

    #[ORM\Column(type: 'datetime')]
    Protected $Date;

    #[ORM\ManyToOne(targetEntity: Doctor::class, inversedBy: 'appointments')]
    Protected $Doctor;

    #[ORM\ManyToOne(targetEntity: Patient::class, inversedBy: 'appointments')]
    Protected $Patient;

    public function getId(): ?int
    {
        return $this->id;
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
