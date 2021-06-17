<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProjetRepository::class)
 */
class Projet
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
     * @var UploadedFile
     * @Assert\File( mimeTypes= {"image/jpeg","image/jpg","image/png"}, maxSize="20000000" )
     */
    private $file;

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
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbr_vote_pour;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbr_vote_null;

    /**
     * @return mixed
     */
    public function getNbrVoteNull()
    {
        return $this->nbr_vote_null;
    }

    /**
     * @param mixed $nbr_vote_null
     * @return Projet
     */
    public function setNbrVoteNull($nbr_vote_null)
    {
        $this->nbr_vote_null = $nbr_vote_null;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNbrVoteContre()
    {
        return $this->nbr_vote_contre;
    }

    /**
     * @param mixed $nbr_vote_contre
     * @return Projet
     */
    public function setNbrVoteContre($nbr_vote_contre)
    {
        $this->nbr_vote_contre = $nbr_vote_contre;
        return $this;
    }
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbr_vote_contre;
    /**
     * @ORM\Column(type="text")
     */
    private $descriptif;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_adm;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_rej;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_date;

    /**
     * @ORM\ManyToOne(targetEntity=Personne::class, inversedBy="projets",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $personne_id;

    /**
     * @ORM\OneToMany(targetEntity=SignalProjet::class, mappedBy="projet_id")
     */
    private $signalProjets;

    /**
     * @ORM\OneToMany(targetEntity=Vote::class, mappedBy="projet_id", orphanRemoval=true)
     */
    private $votes;

    /**
     * @ORM\OneToMany(targetEntity=Follow::class, mappedBy="projet_id")
     */
    private $follows;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="projet_id", orphanRemoval=true)
     */
    private $commentaires;

    public function __construct()
    {
        $this->signalProjets = new ArrayCollection();
        $this->votes = new ArrayCollection();
        $this->follows = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNbrVotePour(): ?int
    {
        return $this->nbr_vote_pour;
    }

    public function setNbrVotePour(?int $nbr_vote_pour): self
    {
        $this->nbr_vote_pour = $nbr_vote_pour;

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

    public function getDateAdm(): ?\DateTimeInterface
    {
        return $this->date_adm;
    }

    public function setDateAdm(?\DateTimeInterface $date_adm): self
    {
        $this->date_adm = $date_adm;

        return $this;
    }

    public function getDateRej(): ?\DateTimeInterface
    {
        return $this->date_rej;
    }

    public function setDateRej(?\DateTimeInterface $date_rej): self
    {
        $this->date_rej = $date_rej;

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

    public function getPersonneId(): ?Personne
    {
        return $this->personne_id;
    }

    public function setPersonneId(?Personne $personne_id): self
    {
        $this->personne_id = $personne_id;

        return $this;
    }

    /**
     * @return Collection|SignalProjet[]
     */
    public function getSignalProjets(): Collection
    {
        return $this->signalProjets;
    }

    public function addSignalProjet(SignalProjet $signalProjet): self
    {
        if (!$this->signalProjets->contains($signalProjet)) {
            $this->signalProjets[] = $signalProjet;
            $signalProjet->setProjetId($this);
        }

        return $this;
    }

    public function removeSignalProjet(SignalProjet $signalProjet): self
    {
        if ($this->signalProjets->removeElement($signalProjet)) {
            // set the owning side to null (unless already changed)
            if ($signalProjet->getProjetId() === $this) {
                $signalProjet->setProjetId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Vote[]
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }

    public function addVote(Vote $vote): self
    {
        if (!$this->votes->contains($vote)) {
            $this->votes[] = $vote;
            $vote->setProjetId($this);
        }

        return $this;
    }

    public function removeVote(Vote $vote): self
    {
        if ($this->votes->removeElement($vote)) {
            // set the owning side to null (unless already changed)
            if ($vote->getProjetId() === $this) {
                $vote->setProjetId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Follow[]
     */
    public function getFollows(): Collection
    {
        return $this->follows;
    }

    public function addFollow(Follow $follow): self
    {
        if (!$this->follows->contains($follow)) {
            $this->follows[] = $follow;
            $follow->setProjetId($this);
        }

        return $this;
    }

    public function removeFollow(Follow $follow): self
    {
        if ($this->follows->removeElement($follow)) {
            // set the owning side to null (unless already changed)
            if ($follow->getProjetId() === $this) {
                $follow->setProjetId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setProjetId($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getProjetId() === $this) {
                $commentaire->setProjetId(null);
            }
        }

        return $this;
    }
}
