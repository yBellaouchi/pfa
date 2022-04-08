<?php

namespace App\Entity;

use App\Repository\ConsultationRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

#[ORM\Entity(repositoryClass: ConsultationRepository::class)]
class Consultation extends RendezVous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $TypeConsultation;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */



    public function getTypeConsultation()
    {
        return $this->TypeConsultation;
    }

    public function setTypeConsultation(string $TypeConsultation)
    {
        $this->TypeConsultation = $TypeConsultation;

        return $this;
    }



    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->RendezVous->Date;
    }

    /**
     * @param mixed $Date
     */
    public function setDate($Date)
    {
        $this->RendezVous->Date = $Date;
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
        $this->RendezVous->Patient = $Patient;
    }

}
