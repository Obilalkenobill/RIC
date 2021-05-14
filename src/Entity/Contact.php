<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Personne::class, inversedBy="contacts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $personne1_id;

    /**
     * @ORM\ManyToOne(targetEntity=Personne::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $personne2_id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $creation_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersonne1Id(): ?Personne
    {
        return $this->personne1_id;
    }

    public function setPersonne1Id(?Personne $personne1_id): self
    {
        $this->personne1_id = $personne1_id;

        return $this;
    }

    public function getPersonne2Id(): ?Personne
    {
        return $this->personne2_id;
    }

    public function setPersonne2Id(?Personne $personne2_id): self
    {
        $this->personne2_id = $personne2_id;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(?\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }
}
