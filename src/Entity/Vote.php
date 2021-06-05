<?php

namespace App\Entity;

use App\Repository\VoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoteRepository::class)
 * @ORM\Table(
 *    name="vote",
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(name="assignment_unique", columns={"personne_id", "projet_id"})
 *    }
 * )
 */
class Vote
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Projet::class, inversedBy="votes")
     * @ORM\JoinColumn(name="projet_id", nullable=false)
     */
    private $projet_id;

    /**
     * @ORM\ManyToOne(targetEntity=Personne::class, inversedBy="votes", cascade={"persist"})
     * @ORM\JoinColumn(name="personne_id", nullable=false)
     */
    private $personne_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bull_vote;

    /**
     * @ORM\Column(type="integer")
     */
    private $a_vote;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_date;

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

    public function getBullVote(): ?bool
    {
        return $this->bull_vote;
    }

    public function setBullVote(?bool $bull_vote): self
    {
        $this->bull_vote = $bull_vote;

        return $this;
    }

    public function getAVote(): ?bool
    {
        return $this->a_vote;
    }

    public function setAVote(bool $a_vote): self
    {
        $this->a_vote = $a_vote;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }
}
