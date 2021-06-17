<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommentaireRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=CommentaireRepository::class)
 */
class Commentaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column (nullable=true, type="string")
     */
    private $mimeType;

      /**
     * @var UploadedFile
     * @Assert\File(mimeTypes= {"image/jpeg","image/jpg","image/png"}, maxSize="20000000" )
     */
    private $file;


    /**
     * @return mixed
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @param mixed $mimeType
     */
    public function setMimeType($mimeType): void
    {
        $this->mimeType = $mimeType;
    }

    /**
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file): void
    {
        $this->file = $file;
    }
    /**
     * @ORM\ManyToOne(targetEntity=Projet::class, inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $projet_id;

    /**
     * @ORM\ManyToOne(targetEntity=Personne::class, inversedBy="commentaires",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $personne_id;

    /**
     * @ORM\Column(type="text")
     */
    private $commentaire;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modif_date;

    /**
     * @ORM\ManyToOne(targetEntity=Commentaire::class, inversedBy="commentaires",cascade={"persist"})
     */
    private $commentaire_referent_id;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="commentaire_referent_id")
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity=SignalCommentaire::class, mappedBy="commentaire_id")
     */
    private $signalCommentaires;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->signalCommentaires = new ArrayCollection();
    }

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

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

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

    public function getModifDate(): ?\DateTimeInterface
    {
        return $this->modif_date;
    }

    public function setModifDate(?\DateTimeInterface $modif_date): self
    {
        $this->modif_date = $modif_date;

        return $this;
    }

    public function getCommentaireReferentId(): ?self
    {
        return $this->commentaire_referent_id;
    }

    public function setCommentaireReferentId(?self $commentaire_referent_id): self
    {
        $this->commentaire_referent_id = $commentaire_referent_id;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(self $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setCommentaireReferentId($this);
        }

        return $this;
    }

    public function removeCommentaire(self $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getCommentaireReferentId() === $this) {
                $commentaire->setCommentaireReferentId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SignalCommentaire[]
     */
    public function getSignalCommentaires(): Collection
    {
        return $this->signalCommentaires;
    }

    public function addSignalCommentaire(SignalCommentaire $signalCommentaire): self
    {
        if (!$this->signalCommentaires->contains($signalCommentaire)) {
            $this->signalCommentaires[] = $signalCommentaire;
            $signalCommentaire->setCommentaireId($this);
        }

        return $this;
    }

    public function removeSignalCommentaire(SignalCommentaire $signalCommentaire): self
    {
        if ($this->signalCommentaires->removeElement($signalCommentaire)) {
            // set the owning side to null (unless already changed)
            if ($signalCommentaire->getCommentaireId() === $this) {
                $signalCommentaire->setCommentaireId(null);
            }
        }

        return $this;
    }
}
