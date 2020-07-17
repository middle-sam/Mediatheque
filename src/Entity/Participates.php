<?php

namespace App\Entity;

use App\Repository\ParticipatesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity(repositoryClass=ParticipatesRepository::class)
 */
class Participates
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $places;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="participatesId")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    /**
     * @ORM\ManyToOne(targetEntity=MeetUp::class)
     */
    private $meetUpId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaces(): ?int
    {
        return $this->places;
    }

    public function setPlaces(int $places): self
    {
        $this->places = $places;

        return $this;
    }

    public function getUserId(): ?user
    {
        return $this->userId;
    }

    public function setUserId(?user $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getMeetUpId(): ?meetUp
    {
        return $this->meetUpId;
    }

    public function setMeetUpId(?meetUp $meetUpId): self
    {
        $this->meetUpId = $meetUpId;

        return $this;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('places', new Assert\LessThanOrEqual(5));
    }
}
