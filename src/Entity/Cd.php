<?php

namespace App\Entity;

use App\Repository\CdRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CdRepository::class)
 */
class Cd extends Documents
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
    private $plages;

    /**
     * @ORM\Column(type="string")
     */
    private $duration;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlages(): ?int
    {
        return $this->plages;
    }

    public function setPlages(int $plages): self
    {
        $this->plages = $plages;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }
}
