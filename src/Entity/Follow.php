<?php

namespace App\Entity;

use App\Repository\FollowRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FollowRepository::class)
* @ORM\Table(
 *    name="Follow",
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(name="assignment_unique", columns={"personne_id_id", "projet_id_id"})
 *    }
 * )
 */
class Follow
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Projet::class, inversedBy="follows", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $projet_id;

    /**
     * @ORM\ManyToOne(targetEntity=Personne::class, inversedBy="follows", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $personne_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjetId(): ?Projet
    {
        return $this->projet_id;
    }

    public function setProjetId(?Projet $projet_id): self
    {
        $this->projet_id = $projet_id;

        return $this;
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
}
