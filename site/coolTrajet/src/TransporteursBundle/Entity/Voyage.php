<?php

namespace TransporteursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Voyage
 *
 * @ORM\Table(name="voyage")
 * @ORM\Entity(repositoryClass="TransporteursBundle\Repository\VoyageRepository")
 */
class Voyage
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateAller", type="date", nullable=true)
     */
    private $dateAller;
    /**
     * @var string
     *
     * @ORM\Column(name="paysDepart", type="string", length=50, nullable=true)
     */
    private $paysDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="villeDepart", type="string", length=50, nullable=true)
     */
    private $villeDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="paysArriver", type="string", length=50, nullable=true)
     */
    private $paysArriver;

    /**
     * @var string
     *
     * @ORM\Column(name="villeArriver", type="string", length=50)
     */
    private $villeArriver;

    /**
     * @var bool
     *
     * @ORM\Column(name="commander", type="boolean", nullable=true)
     */
    private $commander;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateRetoure", type="date", nullable=true)
     */
    private $dateRetoure;

	/**
	 * @ORM\ManyToOne(targetEntity="TransporteursBundle\Entity\Transporteurs",inversedBy="trajet")
	 * @ORM\JoinColumn(nullable=FALSE)
	 */
    private $Parcours;
    
    /**
     * @ORM\OneToMany(targetEntity="ClientsBundle\Entity\Validation", mappedBy="estVerifie", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    private $faireValide;
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
     * @return Voyage
     */
    public function setpaysDepart($paysDepart)
    {
        $this->paysDepart = $paysDepart;

        return $this;
    }

    /**
     * Get paysDepart
     *
     * @return string
     */
    public function getpaysDepart()
    {
        return $this->paysDepart;
    }

    /**
     * Set villeDepart
     *
     * @param string $villeDepart
     *
     * @return Voyage
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
     * @return Voyage
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
     * @return Voyage
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
     * Set commander
     *
     * @param boolean $commander
     *
     * @return Voyage
     */
    public function setCommander($commander)
    {
        $this->commander = $commander;

        return $this;
    }

    /**
     * Get commander
     *
     * @return bool
     */
    public function getCommander()
    {
        return $this->commander;
    }

    /**
     * Set dateRetoure
     *
     * @param \DateTime $dateRetoure
     *
     * @return Voyage
     */
    public function setDateRetoure($dateRetoure)
    {
        $this->dateRetoure = $dateRetoure;

        return $this;
    }

    /**
     * Get dateRetoure
     *
     * @return \DateTime
     */
    public function getDateRetoure()
    {
        return $this->dateRetoure;
    }

    /**
     * Set dateAller
     *
     * @param \DateTime $dateAller
     *
     * @return Voyage
     */
    public function setDateAller($dateAller)
    {
        $this->dateAller = $dateAller;

        return $this;
    }

    /**
     * Get dateAller
     *
     * @return \DateTime
     */
    public function getDateAller()
    {
        return $this->dateAller;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->faireValide = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set parcours
     *
     * @param \TransporteursBundle\Entity\Transporteurs $parcours
     *
     * @return Voyage
     */
    public function setParcours(\TransporteursBundle\Entity\Transporteurs $parcours)
    {
        $this->Parcours = $parcours;

        return $this;
    }

    /**
     * Get parcours
     *
     * @return \TransporteursBundle\Entity\Transporteurs
     */
    public function getParcours()
    {
        return $this->Parcours;
    }

    /**
     * Add faireValide
     *
     * @param \ClientsBundle\Entity\Validation $faireValide
     *
     * @return Voyage
     */
    public function addFaireValide(\ClientsBundle\Entity\Validation $faireValide)
    {
        $this->faireValide[] = $faireValide;

        return $this;
    }

    /**
     * Remove faireValide
     *
     * @param \ClientsBundle\Entity\Validation $faireValide
     */
    public function removeFaireValide(\ClientsBundle\Entity\Validation $faireValide)
    {
        $this->faireValide->removeElement($faireValide);
    }

    /**
     * Get faireValide
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFaireValide()
    {
        return $this->faireValide;
    }
}
