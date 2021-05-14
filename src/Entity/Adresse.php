<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdresseRepository::class)
 */
class Adresse
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
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $C_P;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rue;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numero;

    /**
     * @ORM\OneToMany(targetEntity=Habite::class, mappedBy="adresse_id")
     */
    private $habites;

    public function __construct()
    {
        $this->habites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCP(): ?string
    {
        return $this->C_P;
    }

    public function setCP(string $C_P): self
    {
        $this->C_P = $C_P;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * @return Collection|Habite[]
     */
    public function getHabites(): Collection
    {
        return $this->habites;
    }

    public function addHabite(Habite $habite): self
    {
        if (!$this->habites->contains($habite)) {
            $this->habites[] = $habite;
            $habite->setAdresseId($this);
        }

        return $this;
    }

    public function removeHabite(Habite $habite): self
    {
        if ($this->habites->removeElement($habite)) {
            // set the owning side to null (unless already changed)
            if ($habite->getAdresseId() === $this) {
                $habite->setAdresseId(null);
            }
        }

        return $this;
    }
}
