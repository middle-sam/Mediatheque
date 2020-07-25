<?php

namespace App\Entity;

use App\Repository\BorrowingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BorrowingRepository::class)
 */
class Borrowing
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(type="date")
     */
    private $expectedReturnDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $effectiveReturnDate;

    /**
     * @ORM\ManyToOne(targetEntity=Member::class, inversedBy="borrowingId")
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $memberId;

    /**
     * @ORM\ManyToOne(targetEntity=Documents::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $documentId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getExpectedReturnDate(): ?\DateTimeInterface
    {
        return $this->expectedReturnDate;
    }

    public function setExpectedReturnDate(\DateTimeInterface $expectedReturnDate): self
    {
        $this->expectedReturnDate = $expectedReturnDate;

        return $this;
    }

    public function getEffectiveReturnDate(): ?\DateTimeInterface
    {
        return $this->effectiveReturnDate;
    }

    public function setEffectiveReturnDate(?\DateTimeInterface $effectiveReturnDate): self
    {
        $this->effectiveReturnDate = $effectiveReturnDate;

        return $this;
    }

    public function getMemberId(): ?Member
    {
        return $this->memberId;
    }

    public function setMemberId(?Member $memberId): self
    {
        $this->memberId = $memberId;

        return $this;
    }

    public function getDocumentId(): ?Documents
    {
        return $this->documentId;
    }

    public function setDocumentId(?Documents $documentId): self
    {
        $this->documentId = $documentId;

        return $this;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('expectedReturnDate', new Assert\NotBlank());
    }

}
