<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PersonneRepository::class)
 */
class Personne implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $creation_date;

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }

    /**
     * @param mixed $creation_date
     */
    public function setCreationDate($creation_date): void
    {
        $this->creation_date = $creation_date;
    }

    /**
     * @ORM\OneToMany(targetEntity=Contact::class, mappedBy="personne1_id")
     */
    private $contacts;

    /**
     * @ORM\OneToMany(targetEntity=Habite::class, mappedBy="personne_id")
     */
    private $habites;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="expediteur", orphanRemoval=true)
     */
    private $messages;

    /**
     * @ORM\OneToMany(targetEntity=Reception::class, mappedBy="destinataire_s", orphanRemoval=true)
     */
    private $receptions;

    /**
     * @ORM\OneToMany(targetEntity=Projet::class, mappedBy="personne_id")
     */
    private $projets;

    /**
     * @ORM\OneToMany(targetEntity=SignalProjet::class, mappedBy="personne_id")
     */
    private $signalProjets;

    /**
     * @ORM\OneToMany(targetEntity=Vote::class, mappedBy="personne_id")
     */
    private $votes;

    /**
     * @ORM\OneToMany(targetEntity=Follow::class, mappedBy="personne_id")
     */
    private $follows;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="personne_id")
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity=SignalCommentaire::class, mappedBy="personne_id")
     */
    private $signalCommentaires;

    /**
     * @ORM\OneToMany(targetEntity=Mentionne::class, mappedBy="personne_id")
     */
    private $mentionnes;

    /**
     * @ORM\OneToMany(targetEntity=RolePers::class, mappedBy="personne_id")
     *
     */
    private $rolePers;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $salt;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default" : 0})
     * @Assert\Range(min = 0, max = 1)
     */

    private $isActive;
    /**
     * @ORM\Column(type="integer", nullable=true, options={"default" : 0})
     * @Assert\Range(min = 0,max = 1)
     */

    private $isVerified;
   /**
     * @ORM\Column(type="bigint", unique=true)
     */
    private $nn;

    /**
     * Get the value of nn
     */ 
    public function getnn()
    {
        return $this->nn;
    }

    /**
     * Set the value of nn
     *
     * @return  self
     */ 
    public function setnn($nn)
    {
        $this->nn = $nn;

        return $this;
    }
        /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $photoverif;

    /**
     * @ORM\Column (nullable=true, type="string")
     */
    private $mimeTypephotoverif;
       /**
      * @var UploadedFile
      * @Assert\File(mimeTypes= {"image/jpeg","image/jpg","image/png"}, maxSize="20000000" )
      */
      private $filephotoverif;
     /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $rectocarteid;

    /**
     * @ORM\Column (nullable=true, type="string")
     */
    private $mimeTyperectocarteid;

      /**
     * @var UploadedFile
     * @Assert\File(mimeTypes= {"image/jpeg","image/jpg","image/png"}, maxSize="20000000" )
     */
    private $filerectocarteid;
    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $versocarteid;

    /**
     * @ORM\Column (nullable=true, type="string")
     */
    private $mimeTypeversocarteid;

      /**
     * @var UploadedFile
     * @Assert\File(mimeTypes= {"image/jpeg","image/jpg","image/png"}, maxSize="20000000" )
     */
    private $fileversocarteid;

 
    public function getphotoverif64(){
        //convertir un blob en base 64
        if($this->getPhotoverif()!=null){
        return base64_encode(stream_get_contents($this->getPhotoverif()));
    }
    return null;
    }
    public function getrectocarteid64(){
        //convertir un blob en base 64
        if($this->getrectocarteid()!=null){
        return base64_encode(stream_get_contents($this->getrectocarteid()));
    }
    return null;
    }
    public function getversocarteid64(){
        //convertir un blob en base 64
        if($this->getversocarteid()!=null){
        return base64_encode(stream_get_contents($this->getversocarteid()));
    }
    return null;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive): void
    {
        $this->isActive = $isActive;
    }

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
        $this->adresse_id = new ArrayCollection();
        $this->habites = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->receptions = new ArrayCollection();
        $this->projets = new ArrayCollection();
        $this->signalProjets = new ArrayCollection();
        $this->votes = new ArrayCollection();
        $this->follows = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->signalCommentaires = new ArrayCollection();
        $this->mentionnes = new ArrayCollection();
        $this->rolePers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setPersonne1Id($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getPersonne1Id() === $this) {
                $contact->setPersonne1Id(null);
            }
        }

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
            $habite->setPersonneId($this);
        }

        return $this;
    }

    public function removeHabite(Habite $habite): self
    {
        if ($this->habites->removeElement($habite)) {
            // set the owning side to null (unless already changed)
            if ($habite->getPersonneId() === $this) {
                $habite->setPersonneId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setExpediteur($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getExpediteur() === $this) {
                $message->setExpediteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reception[]
     */
    public function getReceptions(): Collection
    {
        return $this->receptions;
    }

    public function addReception(Reception $reception): self
    {
        if (!$this->receptions->contains($reception)) {
            $this->receptions[] = $reception;
            $reception->setDestinataireS($this);
        }

        return $this;
    }

    public function removeReception(Reception $reception): self
    {
        if ($this->receptions->removeElement($reception)) {
            // set the owning side to null (unless already changed)
            if ($reception->getDestinataireS() === $this) {
                $reception->setDestinataireS(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Projet[]
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): self
    {
        if (!$this->projets->contains($projet)) {
            $this->projets[] = $projet;
            $projet->setPersonneId($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): self
    {
        if ($this->projets->removeElement($projet)) {
            // set the owning side to null (unless already changed)
            if ($projet->getPersonneId() === $this) {
                $projet->setPersonneId(null);
            }
        }

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
            $signalProjet->setPersonneId($this);
        }

        return $this;
    }

    public function removeSignalProjet(SignalProjet $signalProjet): self
    {
        if ($this->signalProjets->removeElement($signalProjet)) {
            // set the owning side to null (unless already changed)
            if ($signalProjet->getPersonneId() === $this) {
                $signalProjet->setPersonneId(null);
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
            $vote->setPersonneId($this);
        }

        return $this;
    }

    public function removeVote(Vote $vote): self
    {
        if ($this->votes->removeElement($vote)) {
            // set the owning side to null (unless already changed)
            if ($vote->getPersonneId() === $this) {
                $vote->setPersonneId(null);
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
            $follow->setPersonneId($this);
        }

        return $this;
    }

    public function removeFollow(Follow $follow): self
    {
        if ($this->follows->removeElement($follow)) {
            // set the owning side to null (unless already changed)
            if ($follow->getPersonneId() === $this) {
                $follow->setPersonneId(null);
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
            $commentaire->setPersonneId($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getPersonneId() === $this) {
                $commentaire->setPersonneId(null);
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
            $signalCommentaire->setPersonneId($this);
        }

        return $this;
    }

    public function removeSignalCommentaire(SignalCommentaire $signalCommentaire): self
    {
        if ($this->signalCommentaires->removeElement($signalCommentaire)) {
            // set the owning side to null (unless already changed)
            if ($signalCommentaire->getPersonneId() === $this) {
                $signalCommentaire->setPersonneId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Mentionne[]
     */
    public function getMentionnes(): Collection
    {
        return $this->mentionnes;
    }

    public function addMentionne(Mentionne $mentionne): self
    {
        if (!$this->mentionnes->contains($mentionne)) {
            $this->mentionnes[] = $mentionne;
            $mentionne->setPersonneId($this);
        }

        return $this;
    }

    public function removeMentionne(Mentionne $mentionne): self
    {
        if ($this->mentionnes->removeElement($mentionne)) {
            // set the owning side to null (unless already changed)
            if ($mentionne->getPersonneId() === $this) {
                $mentionne->setPersonneId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RolePers[]
     */
    public function getRolePers(): Collection
    {
        return $this->rolePers;
    }

    public function addRolePer(RolePers $rolePer): self
    {
        if (!$this->rolePers->contains($rolePer)) {
            $this->rolePers[] = $rolePer;
            $rolePer->setPersonneId($this);
        }

        return $this;
    }

    public function removeRolePer(RolePers $rolePer): self
    {
        if ($this->rolePers->removeElement($rolePer)) {
            // set the owning side to null (unless already changed)
            if ($rolePer->getPersonneId() === $this) {
                $rolePer->setPersonneId(null);
            }
        }

        return $this;
    }

    public function getRoles()
    {
    $roles = array();
        foreach ($this->getRolePers() as $RolePers)
        {
            $roles[]=$RolePers->getRoleId()->getLabel();
        }
    return $roles;

    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function setSalt($salt): self
    {
        $this->salt = $salt;

        return $this;
    }


    /**
     * Get the value of isVerified
     */ 
    public function getIsVerified()
    {
        return $this->isVerified;
    }

    /**
     * Set the value of isVerified
     *
     * @return  self
     */ 
    public function setIsVerified($isVerified)
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * Get the value of rectocarteid
     */ 
    public function getrectocarteid()
    {
        return $this->rectocarteid;
    }

    /**
     * Set the value of rectocarteid
     *
     * @return  self
     */ 
    public function setrectocarteid($rectocarteid)
    {
        $this->rectocarteid = $rectocarteid;

        return $this;
    }

    /**
     * Get the value of mimeTyperectocarteid
     */ 
    public function getmimeTyperectocarteid()
    {
        return $this->mimeTyperectocarteid;
    }

    /**
     * Set the value of mimeTyperectocarteid
     *
     * @return  self
     */ 
    public function setmimeTyperectocarteid($mimeTyperectocarteid)
    {
        $this->mimeTyperectocarteid = $mimeTyperectocarteid;

        return $this;
    }

    /**
     * Set the value of filerectocarteid
     *
     * @param  UploadedFile  $filerectocarteid
     *
     * @return  self
     */ 
    public function setfilerectocarteid(UploadedFile $filerectocarteid)
    {
        $this->filerectocarteid = $filerectocarteid;

        return $this;
    }

    /**
     * Get the value of versocarteid
     */ 
    public function getversocarteid()
    {
        return $this->versocarteid;
    }

    /**
     * Set the value of versocarteid
     *
     * @return  self
     */ 
    public function setversocarteid($versocarteid)
    {
        $this->versocarteid = $versocarteid;

        return $this;
    }

    /**
     * Get the value of mimeTypeversocarteid
     */ 
    public function getmimeTypeversocarteid()
    {
        return $this->mimeTypeversocarteid;
    }

    /**
     * Set the value of mimeTypeversocarteid
     *
     * @return  self
     */ 
    public function setmimeTypeversocarteid($mimeTypeversocarteid)
    {
        $this->mimeTypeversocarteid = $mimeTypeversocarteid;

        return $this;
    }

    /**
     * Get the value of fileversocarteid
     *
     * @return  UploadedFile
     */ 
    public function getfileversocarteid()
    {
        return $this->fileversocarteid;
    }

    /**
     * Set the value of fileversocarteid
     *
     * @param  UploadedFile  $fileversocarteid
     *
     * @return  self
     */ 
    public function setfileversocarteid(UploadedFile $fileversocarteid)
    {
        $this->fileversocarteid = $fileversocarteid;

        return $this;
    }

    /**
     * Get the value of photoverif
     */ 
    public function getPhotoverif()
    {
        return $this->photoverif;
    }

    /**
     * Set the value of photoverif
     *
     * @return  self
     */ 
    public function setPhotoverif($photoverif)
    {
        $this->photoverif = $photoverif;

        return $this;
    }

    /**
     * Get the value of mimeTypephotoverif
     */ 
    public function getMimeTypephotoverif()
    {
        return $this->mimeTypephotoverif;
    }

    /**
     * Set the value of mimeTypephotoverif
     *
     * @return  self
     */ 
    public function setMimeTypephotoverif($mimeTypephotoverif)
    {
        $this->mimeTypephotoverif = $mimeTypephotoverif;

        return $this;
    }

      /**
       * Get the value of filephotoverif
       *
       * @return  UploadedFile
       */ 
      public function getFilephotoverif()
      {
            return $this->filephotoverif;
      }

      /**
       * Set the value of filephotoverif
       *
       * @param  UploadedFile  $filephotoverif
       *
       * @return  self
       */ 
      public function setFilephotoverif(UploadedFile $filephotoverif)
      {
            $this->filephotoverif = $filephotoverif;

            return $this;
      }
}
