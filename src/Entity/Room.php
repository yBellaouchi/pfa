<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    private $Number;

    #[ORM\OneToMany(mappedBy: 'Room', targetEntity: Operation::class)]
    private $Operations;

    #[ORM\ManyToOne(targetEntity: Floor::class, inversedBy: 'Floors')]
    private $Floor;

    public function __construct()
    {
        $this->Operations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->Number;
    }

    public function setNumber(string $Number): self
    {
        $this->Number = $Number;

        return $this;
    }

    /**
     * @return Collection<int, Operation>
     */
    public function getOperations(): Collection
    {
        return $this->Operations;
    }

    public function addOperation(Operation $operation): self
    {
        if (!$this->Operations->contains($operation)) {
            $this->Operations[] = $operation;
            $operation->setRoom($this);
        }

        return $this;
    }

    public function removeOperation(Operation $operation): self
    {
        if ($this->Operations->removeElement($operation)) {
            // set the owning side to null (unless already changed)
            if ($operation->getRoom() === $this) {
                $operation->setRoom(null);
            }
        }

        return $this;
    }

    public function getFloor(): ?Floor
    {
        return $this->Floor;
    }

    public function setFloor(?Floor $Floor): self
    {
        $this->Floor = $Floor;

        return $this;
    }
}
