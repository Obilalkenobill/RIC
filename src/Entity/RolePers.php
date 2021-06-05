<?php

namespace App\Entity;

use App\Repository\RolePersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RolePersRepository::class)
 * @ORM\Table(
 *    name="RolePers",
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(name="assignment_unique", columns={"personne_id", "role_id"})
 *    }
 * )
 */
class RolePers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Personne::class, inversedBy="rolePers")
     * @ORM\JoinColumn(name="personne_id", nullable=false)
     */
    private $personne_id;

    /**
     * @ORM\ManyToOne(targetEntity=Role::class, inversedBy="rolePers")
     * @ORM\JoinColumn(name="role_id", nullable=false)
     */
    private $role_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersonneId(): ?Personne
    {
        return $this->personne_id;
    }

    public function setPersonneId(?Personne $personne_id): self
    {
        $this->personne_id = $personne_id;

        return $this;
    }

    public function getRoleId(): ?Role
    {
        return $this->role_id;
    }

    public function setRoleId(?Role $role_id): self
    {
        $this->role_id = $role_id;

        return $this;
    }
}
