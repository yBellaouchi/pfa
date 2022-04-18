<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\ORM\Mapping as ORM;



/**
 * 
 * 
 * @ORM\Entity
 * @InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"appointment" = "Appointment", "consultation" = "Consultation", "operation" = "Operation"})
 * @ORM\Entity(repositoryClass="App\Repository\AppointmentRepository")
*/
class Appointment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'datetime')]
    protected $Date;

    #[ORM\ManyToOne(targetEntity: Doctor::class, inversedBy: 'appointments')]
    protected $Doctor;

    #[ORM\ManyToOne(targetEntity: Patient::class, inversedBy: 'appointments')]
    protected $Patient;

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
