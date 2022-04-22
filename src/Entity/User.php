<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[InheritanceType("SINGLE_TABLE")]
#[DiscriminatorColumn(name:"Role",type:"string")]
#[DiscriminatorMap(["admin" => Admin::class, "doctor" => Doctor::class])]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string', length: 255)]
    protected $Login;

    #[ORM\Column(type: 'string', length: 255)]
    protected $Password;

    #[ORM\Column(type: 'string', length: 255)]
    protected $Cin;
    #[ORM\Column(type: 'string', length: 255)]
    private $FullName;

  

    public function getName(): ?string
    {
        return $this->FullName;
    }

    public function setName(string $FullName): self
    {
        $this->FullName = $FullName;

        return $this;
    }


    // #[ORM\Column(type: 'string', length: 255)]
    // protected $Role;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->Login;
    }

    public function setLogin(string $Login): self
    {
        $this->Login = $Login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

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

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRoles(string $role): self
    {
        $this->role = $role;

        return $this;
    }
}
