<?php

namespace App\Model;

use App\Entity\Personne;
use Doctrine\DBAL\Types\BigIntType;
use Symfony\Component\Validator\Constraints as Assert;

class PersonneDTO
{
    /**
     * @var string
     * @Assert\Length(min=1, minMessage="Le nom doit avoir au moins un caractère !",max=20,maxMessage="Le nom ne peut pas dépasser 20 caractères !")
     */
    private string $nom;

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return PersonneDTO
     */
    public function setNom(string $nom): PersonneDTO
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     * @return PersonneDTO
     */
    public function setPrenom(string $prenom): PersonneDTO
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return PersonneDTO
     */
    public function setLogin(string $login): PersonneDTO
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return PersonneDTO
     */
    public function setEmail(string $email): PersonneDTO
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return PersonneDTO
     */
    public function setPassword(string $password): PersonneDTO
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @var string
     * @Assert\Length(min=1, minMessage="Le prénom doit avoir au moins un caractère !",max=20,maxMessage="Le prénom ne peut pas dépasser 20 caractères !")
     */
    private string $prenom;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min=1, minMessage="Le login doit avoir au moins un caractère !",max=20,maxMessage="Le login ne peut pas dépasser 20 caractères !")
     */
    private string $login;

    /**
     * @var string
     * @Assert\Email(message="L'email {{ value }} n'est pas valide.")
     */
    private string $email;

    /**
     * @var string
     * @Assert\NotBlank ()
     */
    private string $password;

    /**
     * @return Personne
     */
    public function toEntity():Personne{
        $personne= new Personne();
        $personne->setPassword($this->password)
            ->setNom($this->nom)
            ->setPrenom($this->prenom)
            ->setLogin($this->login)
            ->setEmail($this->email)
            ->setnn($this->nn)
            ;
        return $personne;
    }

    /**
     * @Assert\NotBlank ()
     * @Assert\Positive()
     * @Assert\Range(min=00000000000,max=99999999999)
     */
    private float $nn;

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



    
    //     /**
    //  * @Assert\Type(type="blob", nullable=true)
    //  */
    // private $photoverif;

    // /**
    //  * @ORM\Column (nullable=true, type="string")
    //  */
    // private $mimeTypephotoverif;
    //    /**
    //   * @var UploadedFile
    //   * @Assert\File(mimeTypes= {"image/jpeg","image/jpg","image/png"}, maxSize="20000000" )
    //   */
    //   private $filephotoverif;
    //  /**
    //  * @Assert\Type(type="blob", nullable=true)
    //  */
    // private $rectocarteid;

    // /**
    //  * @ORM\Column (nullable=true, type="string")
    //  */
    // private $mimeTyperectocarteid;

    //   /**
    //  * @var UploadedFile
    //  * @Assert\File(mimeTypes= {"image/jpeg","image/jpg","image/png"}, maxSize="20000000" )
    //  */
    // private $filerectocarteid;
    // /**
    //  * @Assert\Type(type="blob", nullable=true)
    //  */
    // private $versocarteid;

    // /**
    //  * @ORM\Column (nullable=true, type="string")
    //  */
    // private $mimeTypeversocarteid;

    //   /**
    //  * @var UploadedFile
    //  * @Assert\File(mimeTypes= {"image/jpeg","image/jpg","image/png"}, maxSize="20000000" )
    //  */
    // private $fileversocarteid;
}