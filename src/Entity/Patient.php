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
    protected $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $FullName;

    // #[ORM\Column(type: 'string', length: 255)]
    // private $LastName;

    #[ORM\Column(type: 'string', length: 255)]
    private $Cin;

    #[ORM\Column(type: 'string', length: 255)]
    private $Gender;


    #[ORM\Column(type: 'string', length: 255)]
    private $Tel;


    #[ORM\OneToMany(mappedBy: 'Patient', targetEntity: Observation::class)]
    private $observations;

    #[ORM\OneToMany(mappedBy: 'Patient', targetEntity: Appointment::class)]
    private $appointments;

    public function __construct()
    {
        $this->observations = new ArrayCollection();
        $this->appointments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getFullName(): ?string
    {
        return $this->FullName;
    }

    public function setFullName(string $FullName): self
    {
        $this->FullName = $FullName;

        return $this;
    }

   

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->Cin;
    }

    public function setCin(string $Cin): self
    {
        $this->Cin = $Cin;

        return $this;
    }
    public function getGender(): ?string
    {
        return $this->Gender;
    }
    

    public function setGender(string $Gender): self
    {
        $this->Gender = $Gender;

        return $this;
    }
    public function getSexe(): ?string
    {
        return $this->Gender;
    }
    

    public function setSexe(string $Gender): self
    {
        $this->Gender = $Gender;

        return $this;
    }
    public function getTel(): ?string
    {
        return $this->Tel;
    }
    

    public function setTel(string $Tel): self
    {
        $this->Tel = $Tel;

        return $this;
    }

    /**
     * @return Collection<int, Observation>
     */
    public function getObservations(): Collection
    {
        return $this->observations;
    }

    public function addObservation(Observation $observation): self
    {
        if (!$this->observations->contains($observation)) {
            $this->observations[] = $observation;
            $observation->setPatient($this);
        }

        return $this;
    }

    public function removeObservation(Observation $observation): self
    {
        if ($this->observations->removeElement($observation)) {
            // set the owning side to null (unless already changed)
            if ($observation->getPatient() === $this) {
                $observation->setPatient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Appointment>
     */
    public function getAppointments(): Collection
    {
        return $this->appointments;
    }

    public function addAppointment(Appointment $appointment): self
    {
        if (!$this->appointments->contains($appointment)) {
            $this->appointments[] = $appointment;
            $appointment->setPatient($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointments->removeElement($appointment)) {
            // set the owning side to null (unless already changed)
            if ($appointment->getPatient() === $this) {
                $appointment->setPatient(null);
            }
        }

        return $this;
    }
}
