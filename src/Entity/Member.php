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
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $membershipDate;


    /**
     * @ORM\OneToMany(targetEntity=Borrowing::class, mappedBy="memberId")
     */
    protected $borrowingId;

    public function __construct()
    {
        $this->borrowingId = new ArrayCollection();
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
    public function getBorrowingId(): Collection
    {
        return $this->borrowingId;
    }

    public function addBorrowingId(Borrowing $borrowingId): self
    {
        if (!$this->borrowingId->contains($borrowingId)) {
            $this->borrowingId[] = $borrowingId;
            $borrowingId->setMemberId($this);
        }

        return $this;
    }

    public function removeBorrowingId(Borrowing $borrowingId): self
    {
        if ($this->borrowingId->contains($borrowingId)) {
            $this->borrowingId->removeElement($borrowingId);
            // set the owning side to null (unless already changed)
            if ($borrowingId->getMemberId() === $this) {
                $borrowingId->setMemberId(null);
            }
        }

        return $this;
    }



}
