<?php

namespace App\Entity;

use App\Repository\OperationRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Medecin;
#[ORM\Entity(repositoryClass: OperationRepository::class)]
class Operation extends RendezVous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $TypeOperation;

    public function getId()
    {
        return $this->id;
    }

    public function getTypeOperation()
    {
        return $this->TypeOperation;
    }
    public function setTypeOperation(string $TypeOperation)
    {
        $this->TypeOperation = $TypeOperation;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->RendezVou->Date;
    }

    /**
     * @param mixed $Date
     */
    public function setDate($Date)
    {
        $this->RendezVou->Date= $Date;
    }

    /**
     * @return mixed
     */
    public function getMedecin()
    {
        return $this->RendezVous->Medecin;
    }

    /**
     * @param mixed $Medecin
     */
    public function setMedecin($Medecin)
    {
        $this->RendezVous->Medecin = $Medecin;
    }

    /**
     * @return mixed
     */
    public function getPatient()
    {
        return $this->RendezVous->Patient;
    }

    /**
     * @param mixed $Patient
     */
    public function setPatient($Patient)
    {
        $this->RendezVous->Patient= $Patient;
    }


}
