<?php
// UserBundle/Entity/User.php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\MappedSuperclass
 * @ORM\Entity
 * @ORM\Table(name="User")
 */
class User extends BaseUser 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected   $id;
   
    /** @ORM\OneToMany(targetEntity="AppBundle\Entity\EventCustom", mappedBy="rdv", cascade={"persist","merge","remove"})
     *@ORM\joinColumn(name="utilisateur")
     */
    private $eleve;
    
    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez remplir le champ s'il vous plâit.", groups={"Registration", "Profile"})
     * @ORM\Column(name="prenom", type="string",length=20)
     */
    private $prenom;
    
    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez remplir le champ s'il vous plâit.", groups={"Registration", "Profile"})
     * @ORM\Column(name="telephone", type="string",length=35)
     */
    private $telephone;
    
    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez remplir le champ s'il vous plâit.", groups={"Registration", "Profile"})
     * @ORM\Column(name="adresse", type="string",length=80)
     */
    private $adresse;
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

 

  


    /**
     * Add eleve
     *
     * @param \AppBundle\Entity\EventCustom $eleve
     *
     * @return User
     */
    public function addEleve(\AppBundle\Entity\EventCustom $eleve)
    {
        $this->eleve[] = $eleve;

        return $this;
    }

    /**
     * Remove eleve
     *
     * @param \AppBundle\Entity\EventCustom $eleve
     */
    public function removeEleve(\AppBundle\Entity\EventCustom $eleve)
    {
        $this->eleve->removeElement($eleve);
    }

    /**
     * Get eleve
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEleve()
    {
        return $this->eleve;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return User
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
}
