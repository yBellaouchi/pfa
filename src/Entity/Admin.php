<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping as ORM;



#[ORM\Entity(repositoryClass: AdminRepository::class)]

class Admin extends User
{
    


    public function getId(): ?int
    {
         return parent::getId();
    }

   

    public function getLogin(): ?string
    {
        return parent::getLogin(); // TODO: Change the autogenerated stub
    }

    public function setLogin(string $Login): User
    {
        return parent::setLogin($Login); // TODO: Change the autogenerated stub
    }

    public function getPassword(): ?string
    {
        return parent::getPassword(); // TODO: Change the autogenerated stub
    }

    public function setPassword(string $Password): User
    {
        return parent::setPassword($Password); // TODO: Change the autogenerated stub
    }

    public function getCin(): ?string
    {
        return parent::getCin(); // TODO: Change the autogenerated stub
    }

    public function setCin(string $Cin): User
    {
        return parent::setCin($Cin); // TODO: Change the autogenerated stub
    }

   
}
