<?php

namespace App\Entity;

use App\Repository\FloorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FloorRepository::class)]
class Floor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Number;

    #[ORM\OneToMany(mappedBy: 'Floor', targetEntity: Room::class)]
    private $Rooms;

    public function __construct()
    {
        $this->Rooms = new ArrayCollection();
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
     * @return Collection<int, Room>
     */
    public function getRooms(): Collection
    {
        return $this->Rooms;
    }

    public function addRoom(Room $Room): self
    {
        if (!$this->Rooms->contains($Room)) {
            $this->Rooms[] = $Room;
            $Room->setFloor($this);
        }

        return $this;
    }

    public function removeChambre(Room $Room): self
    {
        if ($this->Chambres->removeElement($Room)) {
            // set the owning side to null (unless already changed)
            if ($Room->getFloor() === $this) {
                $Room->setFloor(null);
            }
        }

        return $this;
    }
}
