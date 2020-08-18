<?php

namespace App\Entity;

use App\Repository\MeetUpRepository;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=MeetUpRepository::class)
 */
class MeetUp
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;


    /**
     * @ORM\OneToOne(targetEntity=Creator::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $creatorId;

    /**
     * @ORM\ManyToOne(targetEntity=Employee::class, inversedBy="organizes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $employeeId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEmployeeId(): ?employee
    {
        return $this->employeeId;
    }

    public function setEmployeeId(?employee $employeeId): self
    {
        $this->employeeId = $employeeId;

        return $this;
    }

    public function getCreatorId(): ?creator
    {
        return $this->creatorId;
    }

    public function setCreatorId(creator $creatorId): self
    {
        $this->creatorId = $creatorId;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getCreatorId();
    }

}
