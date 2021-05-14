<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoleRepository::class)
 */
class Role
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity=RolePers::class, mappedBy="role_id")
     */
    private $rolePers;

    public function __construct()
    {
        $this->rolePers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|RolePers[]
     */
    public function getRolePers(): Collection
    {
        return $this->rolePers;
    }

    public function addRolePer(RolePers $rolePer): self
    {
        if (!$this->rolePers->contains($rolePer)) {
            $this->rolePers[] = $rolePer;
            $rolePer->setRoleId($this);
        }

        return $this;
    }

    public function removeRolePer(RolePers $rolePer): self
    {
        if ($this->rolePers->removeElement($rolePer)) {
            // set the owning side to null (unless already changed)
            if ($rolePer->getRoleId() === $this) {
                $rolePer->setRoleId(null);
            }
        }

        return $this;
    }
}
