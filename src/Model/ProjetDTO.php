<?php


namespace App\Model;


use App\Entity\Personne;
use App\Entity\Projet;
use DateTime;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Validator\Constraints as Assert;

class ProjetDTO
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min=25,minMessage="Le titre doit avoir au moins 25 caractères !",max=125,maxMessage="Le titre ne peut pas dépasser 125 caractères !")
     */
 private string $titre;
    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(min=125,minMessage="Le descriptif doit avoir au moins 125 caractères !")
     */
 private string $descriptif;
    /**
     * @var DateTime
     * @Assert\DateTime()
     */
 private DateTime $creation_date;
    /**
     * @var Personne
     */
 private Personne $personne_id;

    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     * @return ProjetDTO
     */
    public function setTitre(string $titre): ProjetDTO
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescriptif(): string
    {
        return $this->descriptif;
    }

    /**
     * @param string $descriptif
     * @return ProjetDTO
     */
    public function setDescriptif(string $descriptif): ProjetDTO
    {
        $this->descriptif = $descriptif;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreationDate(): DateTime
    {
        return $this->creation_date;
    }

    /**
     * @param DateTime $creation_date
     * @return ProjetDTO
     */
    public function setCreationDate(DateTime $creation_date): ProjetDTO
    {
        $this->creation_date = $creation_date;
        return $this;
    }

    /**
     * @return Personne
     */
    public function getPersonneId(): Personne
    {
        return $this->personne_id;
    }

    /**
     * @param Personne $personne_id
     * @return ProjetDTO
     */
    public function setPersonneId(Personne $personne_id): ProjetDTO
    {
        $this->personne_id = $personne_id;
        return $this;
    }

    public function toEntity(){
        $projet=new Projet();
        $projet->setTitre($this->titre)
            ->setCreationDate(DateTime("now"))
            ->setDescriptif($this->descriptif)
            ->setPersonneId($this->personne_id);
        return $projet;
    }
}