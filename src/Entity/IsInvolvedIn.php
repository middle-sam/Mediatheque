<?php

namespace App\Entity;

use App\Repository\IsInvolvedInRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IsInvolvedInRepository::class)
 */
class IsInvolvedIn
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\ManyToOne(targetEntity=creator::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $creatorId;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getCreatorId(): ?creator
    {
        return $this->creatorId;
    }

    public function setCreatorId(?creator $creatorId): self
    {
        $this->creatorId = $creatorId;

        return $this;
    }

}
