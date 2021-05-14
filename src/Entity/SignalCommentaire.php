<?php

namespace App\Entity;

use App\Repository\SignalCommentaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SignalCommentaireRepository::class)
 */
class SignalCommentaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Commentaire::class, inversedBy="signalCommentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commentaire_id;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptif;

    /**
     * @ORM\ManyToOne(targetEntity=Personne::class, inversedBy="signalCommentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $personne_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaireId(): ?Commentaire
    {
        return $this->commentaire_id;
    }

    public function setCommentaireId(?Commentaire $commentaire_id): self
    {
        $this->commentaire_id = $commentaire_id;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

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
