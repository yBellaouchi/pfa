<?php

namespace App\Entity;

use App\Repository\SpecialityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecialityRepository::class)]
class Speciality
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;

    #[ORM\OneToMany(mappedBy: 'speciality', targetEntity: Doctor::class)]
    private $Doctors;

    public function __construct()
    {
        $this->Doctors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return Collection<int, Doctor>
     */
    public function getDoctors(): Collection
    {
        return $this->Doctors;
    }

    public function addDoctor(Doctor $doctor): self
    {
        if (!$this->Doctors->contains($doctor)) {
            $this->Doctors[] = $doctor;
            $doctor->setSpeciality($this);
        }

        return $this;
    }

    public function removeDoctor(Doctor $doctor): self
    {
        if ($this->Doctors->removeElement($doctor)) {
            // set the owning side to null (unless already changed)
            if ($doctor->getSpeciality() === $this) {
                $doctor->setSpeciality(null);
            }
        }

        return $this;
    }
}
