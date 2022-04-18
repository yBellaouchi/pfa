<?php

namespace App\Entity;

use App\Repository\DoctorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use App\Entity\Speciality;


#[ORM\Entity(repositoryClass: DoctorRepository::class)]
class Doctor extends User
{
    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column(type: 'integer')]
    // protected $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $FirstName;

    #[ORM\Column(type: 'string', length: 255)]
    private $LastName;

    #[ORM\Column(type: 'string', length: 255)]
    private $Telelphone;

    

    #[ORM\OneToMany(mappedBy: 'Doctor', targetEntity: Observation::class)]
    private $observations;

    #[ORM\OneToMany(mappedBy: 'Doctor', targetEntity: Appointment::class)]
    private $appointments;

    #[ORM\ManyToOne(targetEntity: Speciality::class, inversedBy: 'Doctors')]
    private $speciality;


    public function __construct()
    {
        $this->observations = new ArrayCollection();
        $this->appointments = new ArrayCollection();
    }

  
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

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

    public function getTelelphone(): ?string
    {
        return $this->Telelphone;
    }

    public function setTelelphone(string $Telelphone): self
    {
        $this->Telelphone = $Telelphone;

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
            $observation->setDoctor($this);
        }

        return $this;
    }

    public function removeObservation(Observation $observation): self
    {
        if ($this->observations->removeElement($observation)) {
            // set the owning side to null (unless already changed)
            if ($observation->getDoctor() === $this) {
                $observation->setDoctor(null);
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
            $appointment->setDoctor($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointments->removeElement($appointment)) {
            // set the owning side to null (unless already changed)
            if ($appointment->getDoctor() === $this) {
                $appointment->setDoctor(null);
            }
        }

        return $this;
    }

    public function getSpeciality(): ?Speciality
    {
        return $this->speciality;
    }

    public function setSpeciality(?Speciality $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

}