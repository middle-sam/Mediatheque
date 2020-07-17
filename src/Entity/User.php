<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"user" = "User", "employee" = "Employee", "member" = "Member"})
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\OneToMany(targetEntity=Participates::class, mappedBy="userId")
     */
    private $participatesId;

    public function __construct()
    {
        $this->participatesId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return Collection|Participates[]
     */
    public function getParticipatesId(): Collection
    {
        return $this->participatesId;
    }

    public function addParticipatesId(Participates $participatesId): self
    {
        if (!$this->participatesId->contains($participatesId)) {
            $this->participatesId[] = $participatesId;
            $participatesId->setUserId($this);
        }

        return $this;
    }

    public function removeParticipatesId(Participates $participatesId): self
    {
        if ($this->participatesId->contains($participatesId)) {
            $this->participatesId->removeElement($participatesId);
            // set the owning side to null (unless already changed)
            if ($participatesId->getUserId() === $this) {
                $participatesId->setUserId(null);
            }
        }

        return $this;
    }
}
