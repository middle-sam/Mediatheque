<?php

namespace App\Entity;

use App\Repository\DocumentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=DocumentsRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"documents" = "Documents", "dvd" = "Dvd", "ebook" = "Ebook", "newspaper" = "Newspaper", "book" = "Book", "cd" = "Cd"})
 * @Vich\Uploadable
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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $img;

    /**
     * @Vich\UploadableField(mapping="documents_images", fileNameProperty="img", size="imageSize")
     * @var File|null
     */
    protected $imageFile;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTimeInterface|null
     */
    protected $updatedAt;


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

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {
        $this->img = $img;

        return $this;
    }


    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }


    /**
     * @param File|null $imageFile
     * @return Documents
     */
    public function setImageFile(?File $imageFile): Documents
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface|null $updatedAt
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): ?\DateTimeInterface
    {
        $this->updatedAt = new \DateTime('now');
    }

}
