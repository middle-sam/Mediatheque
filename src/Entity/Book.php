<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book extends Documents
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $pages;


    ///**
    // * @Vich\UploadableField(mapping="documents_images", fileNameProperty="img", size="imageSize")
    // * @var File|null
    // */
    //protected $imageFile;
//
    ///**
    // * @ORM\Column(type="string", length=255, nullable=true)
    // */
    //private $imageName;
//
    ///**
    // * @ORM\Column(type="datetime")
    // * @var \DateTimeInterface|null
    // */
    //private $updated_at;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPages(): ?int
    {
        return $this->pages;
    }

    public function setPages(int $pages): self
    {
        $this->pages = $pages;

        return $this;
    }

    //public function getImageName(): ?string
    //{
    //    return $this->imageName;
    //}
//
    //public function setImageName(?string $imageName): self
    //{
    //    $this->imageName = $imageName;
//
    //    return $this;
    //}

    //public function getUpdatedAt(): ?\DateTimeInterface
    //{
    //    return $this->updated_at;
    //}

    //public function setUpdatedAt(\DateTimeInterface $updated_at): ?\DateTimeInterface
    //{
    //    $this->updated_at = $updated_at;
    //}
}
