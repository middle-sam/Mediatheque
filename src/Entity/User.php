<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"user" = "User", "employee" = "Employee", "member" = "Member"})
 * @UniqueEntity(fields = {"email", "pseudo"}, message = "L'identifiant que vous avez indiqué est déja utilisé!")
 */
class User implements UserInterface
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
    protected $pseudo;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\Length(min="8", minMessage="Le mot de passe doit contenir au moins caractères!")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $lastName;

    /**
     * @ORM\OneToMany(targetEntity=Participates::class, mappedBy="userId")
     */
    protected $participatesId;

    /**
     * @ORM\Column(type="string", length=180)
     * @Assert\Length(min=8, minMessage="Le mote de passe doit faire au minimum 8 caractères")
     */
    protected $email;

    /**
     * @ORM\ManyToMany(targetEntity=Role::class, inversedBy="users", cascade={"persist"})
     */
    protected $roles;

    public function __construct()
    {
        $this->participatesId = new ArrayCollection();
        $this->roles = new ArrayCollection();
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

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('firstName', new Assert\NotNull());
        $metadata->addPropertyConstraint('lastName', new Assert\NotNull());
        $metadata->addPropertyConstraint('pseudo', new Assert\NotNull());


    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): UserInterface
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->pseudo;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function addRole(Role $role): self
    {

        if(is_null($this->roles))
        {
            $this->roles = new ArrayCollection();
        }
        if($this->roles instanceof ArrayCollection) {
            if (!$this->roles->contains($role)) {
                $this->roles[] = $role;
                $role->addUsers($this);
            }
        }
        return $this;
    }

    public function getRoles()
    {
        $roles = $this->roles;

        $roleName = [];

        if(is_iterable($roles)){

            foreach($roles as $role){
                $roleName[] = $role->getLabel();
            }
        }

        return $roleName;
    }

    public function removeRole(Role $role): self
    {
        if ($this->roles->contains($role)) {
            $this->roles->removeElement($role);
            $role->removeUsers($this);
        }

        return $this;
    }

}
