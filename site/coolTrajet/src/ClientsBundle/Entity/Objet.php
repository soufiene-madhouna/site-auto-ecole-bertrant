<?php

namespace ClientsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Objet
 *
 * @ORM\Table(name="objet")
 * @ORM\Entity(repositoryClass="ClientsBundle\Repository\ObjetRepository")
 */
class Objet
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
     * @ORM\Column(name="paysDepart", type="string", length=60)
     */
    private $paysDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="villeDepart", type="string", length=60)
     */
    private $villeDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="paysArriver", type="string", length=60)
     */
    private $paysArriver;

    /**
     * @var string
     *
     * @ORM\Column(name="villeArriver", type="string", length=60)
     */
    private $villeArriver;

    /**
     * @var string
     *
     * @ORM\Column(name="poids", type="decimal", precision=10, scale=2)
     */
    private $poids;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseLivraison", type="string", length=80)
     */
    private $adresseLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="photoObjet", type="string", length=255)
     */
    private $photoObjet;

	/**
	 * @var boolean
	 * 
	 * @ORM\column(name="visible",type="boolean",nullable=true)
	 */
    private $visible;
    
    /**
     * @ORM\ManyToOne(targetEntity="ClientsBundle\Entity\Clients", inversedBy="Client", cascade={"merge","persist"})
     */
    private $Objets;
    
    /**
     * @ORM\OneToMany(targetEntity="ClientsBundle\Entity\Validation", mappedBy="objet", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    private $validation;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set paysDepart
     *
     * @param string $paysDepart
     *
     * @return Objet
     */
    public function setPaysDepart($paysDepart)
    {
        $this->paysDepart = $paysDepart;

        return $this;
    }

    /**
     * Get paysDepart
     *
     * @return string
     */
    public function getPaysDepart()
    {
        return $this->paysDepart;
    }

    /**
     * Set villeDepart
     *
     * @param string $villeDepart
     *
     * @return Objet
     */
    public function setVilleDepart($villeDepart)
    {
        $this->villeDepart = $villeDepart;

        return $this;
    }

    /**
     * Get villeDepart
     *
     * @return string
     */
    public function getVilleDepart()
    {
        return $this->villeDepart;
    }

    /**
     * Set paysArriver
     *
     * @param string $paysArriver
     *
     * @return Objet
     */
    public function setPaysArriver($paysArriver)
    {
        $this->paysArriver = $paysArriver;

        return $this;
    }

    /**
     * Get paysArriver
     *
     * @return string
     */
    public function getPaysArriver()
    {
        return $this->paysArriver;
    }

    /**
     * Set villeArriver
     *
     * @param string $villeArriver
     *
     * @return Objet
     */
    public function setVilleArriver($villeArriver)
    {
        $this->villeArriver = $villeArriver;

        return $this;
    }

    /**
     * Get villeArriver
     *
     * @return string
     */
    public function getVilleArriver()
    {
        return $this->villeArriver;
    }

    /**
     * Set poids
     *
     * @param string $poids
     *
     * @return Objet
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * Get poids
     *
     * @return string
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set adresseLivraison
     *
     * @param string $adresseLivraison
     *
     * @return Objet
     */
    public function setAdresseLivraison($adresseLivraison)
    {
        $this->adresseLivraison = $adresseLivraison;

        return $this;
    }

    /**
     * Get adresseLivraison
     *
     * @return string
     */
    public function getAdresseLivraison()
    {
        return $this->adresseLivraison;
    }

    /**
     * Set photoObjet
     *
     * @param string $photoObjet
     *
     * @return Objet
     */
    public function setPhotoObjet($photoObjet)
    {
        $this->photoObjet = $photoObjet;

        return $this;
    }

    /**
     * Get photoObjet
     *
     * @return string
     */
    public function getPhotoObjet()
    {
        return $this->photoObjet;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     *
     * @return Objet
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set objets
     *
     * @param \ClientsBundle\Entity\Clients $objets
     *
     * @return Objet
     */
    public function setObjets(\ClientsBundle\Entity\Clients $objets = null)
    {
        $this->Objets = $objets;

        return $this;
    }

    /**
     * Get objets
     *
     * @return \ClientsBundle\Entity\Clients
     */
    public function getObjets()
    {
        return $this->Objets;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->valider = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add valider
     *
     * @param \ClientsBundle\Entity\Objet $valider
     *
     * @return Objet
     */
    public function addValider(\ClientsBundle\Entity\Objet $valider)
    {
        $this->valider[] = $valider;

        return $this;
    }

    /**
     * Remove valider
     *
     * @param \ClientsBundle\Entity\Objet $valider
     */
    public function removeValider(\ClientsBundle\Entity\Objet $valider)
    {
        $this->valider->removeElement($valider);
    }

    /**
     * Get valider
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getValider()
    {
        return $this->valider;
    }

    /**
     * Add validation
     *
     * @param \ClientsBundle\Entity\Validation $validation
     *
     * @return Objet
     */
    public function addValidation(\ClientsBundle\Entity\Validation $validation)
    {
        $this->validation[] = $validation;

        return $this;
    }

    /**
     * Remove validation
     *
     * @param \ClientsBundle\Entity\Validation $validation
     */
    public function removeValidation(\ClientsBundle\Entity\Validation $validation)
    {
        $this->validation->removeElement($validation);
    }

    /**
     * Get validation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getValidation()
    {
        return $this->validation;
    }
}
