<?php

namespace App\Entity;

use App\Repository\DocumentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DocumentsRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"documents" = "Documents", "dvd" = "Dvd", "ebook" = "Ebook", "newspaper" = "Newspaper", "book" = "Book", "cd" = "Cd"})
 */
class Documents
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cote;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $format;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeOeuvre;

    /**
     * @ORM\OneToMany(targetEntity=Ressources::class, mappedBy="documentId")
     */
    private $ressources;

    public function __construct()
    {
        $this->ressources = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCote(): ?string
    {
        return $this->cote;
    }

    public function setCote(string $cote): self
    {
        $this->cote = $cote;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getCodeOeuvre(): ?string
    {
        return $this->codeOeuvre;
    }

    public function setCodeOeuvre(string $codeOeuvre): self
    {
        $this->codeOeuvre = $codeOeuvre;

        return $this;
    }

    /**
     * @return Collection|Ressources[]
     */
    public function getRessources(): Collection
    {
        return $this->ressources;
    }

    public function addRessource(Ressources $ressource): self
    {
        if (!$this->ressources->contains($ressource)) {
            $this->ressources[] = $ressource;
            $ressource->setTitle($this);
        }

        return $this;
    }

    public function removeRessource(Ressources $ressource): self
    {
        if ($this->ressources->contains($ressource)) {
            $this->ressources->removeElement($ressource);
            // set the owning side to null (unless already changed)
            if ($ressource->getTitle() === $this) {
                $ressource->setTitle(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->titre;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('cote', new Assert\NotNull());
        $metadata->addPropertyConstraint('titre', new Assert\NotNull());
        $metadata->addPropertyConstraint('codeOeuvre', new Assert\NotNull());

    }
}
