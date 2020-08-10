<?php

namespace TransporteursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transporteurs
 *
 * @ORM\Table(name="transporteurs")
 * @ORM\Entity(repositoryClass="TransporteursBundle\Repository\TransporteursRepository")
 */
class Transporteurs
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="TypeVehicule", type="string", length=40, nullable=true)
     */
    private $typeVehicule;

	/**
	 * @ORM\OneToOne(targetEntity="UserBundle\Entity\User",)
     * @ORM\JoinColumn(name="Transporteur_id", referencedColumnName="id", nullable=FALSE)
	 */
    private $User;
    
    /**
     * @ORM\OneToMany(targetEntity="TransporteursBundle\Entity\Voyage", mappedBy="Parcours", cascade={"persist","remove"})
     */
    private $trajet;
    /**
     * Get id
     *
     * @return int
     */
    
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=40, nullable=true)
     * 
     */
    private $nom;
    
    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=40, nullable=true)
     *
     */
    private $prenom;
    
    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=90, nullable=true)
     *
     */
    private $adresse;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="codePostal", type="integer", length=5, nullable=true)
     *
     */
    private $codePostal;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=20, nullable=true)
     *
     */
    private $ville;
    
    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=20, nullable=true)
     *
     */
    private $telephone;
    
    
    
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set typeVehicule
     *
     * @param string $typeVehicule
     *
     * @return Transporteurs
     */
    public function setTypeVehicule($typeVehicule)
    {
        $this->typeVehicule = $typeVehicule;

        return $this;
    }

    /**
     * Get typeVehicule
     *
     * @return string
     */
    public function getTypeVehicule()
    {
        return $this->typeVehicule;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Transporteurs
     */
    public function setUser(\UserBundle\Entity\User $user)
    {
        $this->User = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->User;
    }

   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->trajet = new \Doctrine\Common\Collections\ArrayCollection();
        $this->id = new \Doctrine\Common\Collections\ArrayCollection();
        
    }

    /**
     * Add trajet
     *
     * @param \TransporteursBundle\Entity\Voyage $trajet
     *
     * @return Transporteurs
     */
    public function addTrajet(\TransporteursBundle\Entity\Voyage $trajet)
    {
        $this->trajet[] = $trajet;

        return $this;
    }

    /**
     * Remove trajet
     *
     * @param \TransporteursBundle\Entity\Voyage $trajet
     */
    public function removeTrajet(\TransporteursBundle\Entity\Voyage $trajet)
    {
        $this->trajet->removeElement($trajet);
    }

    /**
     * Get trajet
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrajet()
    {
        return $this->trajet;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Transporteurs
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Transporteurs
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
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Transporteurs
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

    /**
     * Set codePostal
     *
     * @param integer $codePostal
     *
     * @return Transporteurs
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return integer
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Transporteurs
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Transporteurs
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
}
