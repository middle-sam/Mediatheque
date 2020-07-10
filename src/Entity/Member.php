<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MemberRepository::class)
 */
class Member extends User
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
    private $membershipDate;

    /**
     * @ORM\OneToMany(targetEntity=Borrowing::class, mappedBy="memberId")
     */
    private $borrowindId;

    public function __construct()
    {
        $this->borrowindId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMembershipDate(): ?\DateTimeInterface
    {
        return $this->membershipDate;
    }

    public function setMembershipDate(\DateTimeInterface $membershipDate): self
    {
        $this->membershipDate = $membershipDate;

        return $this;
    }

    /**
     * @return Collection|Borrowing[]
     */
    public function getBorrowindId(): Collection
    {
        return $this->borrowindId;
    }

    public function addBorrowindId(Borrowing $borrowindId): self
    {
        if (!$this->borrowindId->contains($borrowindId)) {
            $this->borrowindId[] = $borrowindId;
            $borrowindId->setMemberId($this);
        }

        return $this;
    }

    public function removeBorrowindId(Borrowing $borrowindId): self
    {
        if ($this->borrowindId->contains($borrowindId)) {
            $this->borrowindId->removeElement($borrowindId);
            // set the owning side to null (unless already changed)
            if ($borrowindId->getMemberId() === $this) {
                $borrowindId->setMemberId(null);
            }
        }

        return $this;
    }
}
