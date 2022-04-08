<?php

namespace App\Entity;

use App\Entity\Medecin;
use App\Entity\Patient;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Login;

    #[ORM\Column(type: 'string', length: 255)]
    private $Password;
    #[ORM\Column(type: 'string', length: 255)]




    // #[ORM\OneToMany(mappedBy: 'admin', targetEntity: Patient::class)]
    // private $Patient;
    // #[ORM\OneToMany(mappedBy: 'admin', targetEntity: Medecin::class)]
    // private $Medecin;


    public function __construct()
    {
        $this->Patient = new ArrayCollection();
        $this->Medecin = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLogin()
    {
        return $this->Login;
    }

    public function setLogin(string $Login)
    {
        $this->Login = $Login;

        return $this;
    }

    public function getPassword()
    {
        return $this->Password;
    }

    public function setPassword(string $Password)
    {
        $this->Password = $Password;

        return $this;
    }





}
