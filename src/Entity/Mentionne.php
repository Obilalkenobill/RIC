<?php

namespace App\Entity;

use App\Repository\MentionneRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MentionneRepository::class)
 */
class Mentionne
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Commentaire::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $commentaire_id;

    /**
     * @ORM\ManyToOne(targetEntity=Personne::class, inversedBy="mentionnes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $personne_id;

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
