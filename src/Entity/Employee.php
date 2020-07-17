<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 */
class Employee extends User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=Maintenance::class, mappedBy="employeeId")
     */
    private $maintenanceId;

    /**
     * @ORM\OneToMany(targetEntity=MeetUp::class, mappedBy="employeeId")
     */
    private $organizes;

    public function __construct()
    {
        $this->maintenanceId = new ArrayCollection();
        $this->organizes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|Maintenance[]
     */
    public function getMaintenanceId(): Collection
    {
        return $this->maintenanceId;
    }

    public function addMaintenanceId(Maintenance $maintenanceId): self
    {
        if (!$this->maintenanceId->contains($maintenanceId)) {
            $this->maintenanceId[] = $maintenanceId;
            $maintenanceId->setEmployeeId($this);
        }

        return $this;
    }

    public function removeMaintenanceId(Maintenance $maintenanceId): self
    {
        if ($this->maintenanceId->contains($maintenanceId)) {
            $this->maintenanceId->removeElement($maintenanceId);
            // set the owning side to null (unless already changed)
            if ($maintenanceId->getEmployeeId() === $this) {
                $maintenanceId->setEmployeeId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|meetUp[]
     */
    public function getOrganizes(): Collection
    {
        return $this->organizes;
    }

    public function addOrganize(meetUp $organize): self
    {
        if (!$this->organizes->contains($organize)) {
            $this->organizes[] = $organize;
            $organize->setEmployeeId($this);
        }

        return $this;
    }

    public function removeOrganize(meetUp $organize): self
    {
        if ($this->organizes->contains($organize)) {
            $this->organizes->removeElement($organize);
            // set the owning side to null (unless already changed)
            if ($organize->getEmployeeId() === $this) {
                $organize->setEmployeeId(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->email;
    }
}
