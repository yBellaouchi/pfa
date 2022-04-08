<?php

namespace App\Entity;

use App\Repository\InfermierRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InfermierRepository::class)]
class Infermier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $Prenom;

    #[ORM\Column(type: 'string', length: 255)]
    private $Cin;

    #[ORM\Column(type: 'string', length: 255)]
    private $Telephone;



    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->Nom;
    }

    public function setNom(string $Nom)
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom()
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom)
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getCin()
    {
        return $this->Cin;
    }

    public function setCin(string $Cin)
    {
        $this->Cin = $Cin;

        return $this;
    }

    public function getTelephone()
    {
        return $this->Telephone;
    }

    public function setTelephone(string $Telephone)
    {
        $this->Telephone = $Telephone;

        return $this;
    }


}
