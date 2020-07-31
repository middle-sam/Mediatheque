<?php

namespace App\Entity;

use App\Repository\EbookRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EbookRepository::class)
 */
class Ebook extends Documents
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

    public function __toString(): string
    {
        return $this->getPages();
    }
}
