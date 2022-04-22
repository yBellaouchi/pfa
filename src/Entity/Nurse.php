<?php

namespace App\Entity;

use App\Repository\NurseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:NurseRepository::class)]
class Nurse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;


    #[ORM\Column(type: 'string', length: 255)]
    public $FullName;

    // #[ORM\Column(type: 'string', length: 255)]
    // private $LastName;

    #[ORM\Column(type: 'string', length: 255)]
    private $Cin;

    #[ORM\Column(type: 'string', length: 255)]
    private $Tel;

    #[ORM\Column(type: 'string', length: 255)]
    private $Gender;

    public function getId(): ?int
    {
        return $this->id;
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
    public function getFullName(): ?string
    {
        return $this->FullName;
    }

    public function setFirstName(string $FullName): self
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

    public function getTel(): ?string
    {
        return $this->Tel;
    }

    public function setTel(string $Tel): self
    {
        $this->Tel = $Tel;

        return $this;
    }
}
