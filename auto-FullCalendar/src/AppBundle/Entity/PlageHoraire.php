<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlageHoraire
 *
 * @ORM\Table(name="plage_horaire")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlageHoraireRepository")
 */
class PlageHoraire
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
     * @ORM\Column(name="type", type="string", length=30)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut", type="time")
     */
    private $debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="time")
     */
    private $fin;
    
    /**
     * @var string
     *
     * @ORM\Column(name="details", type="string", length=35)
     */
	private $details;
	
	/**
	 *@ORM\OneToMany(targetEntity="AppBundle\Entity\EventCustom", mappedBy="title",cascade={"merge","persist","DETACH"},orphanRemoval=false)
	 * 
	 */
	private $typeEvent;
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
     * Set type
     *
     * @param string $type
     *
     * @return PlageEvenement
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

   
    /**
     * Set debut
     *
     * @param \DateTime $debut
     *
     * @return PlageEvenement
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return \DateTime
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     *
     * @return PlageEvenement
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set details
     *
     * @param string $details
     *
     * @return PlageHoraire
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details
     *
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }

        /**
     * Constructor
     */
    public function __construct()
    {
        $this->typeEvent = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add typeEvent
     *
     * @param \AppBundle\Entity\EventCustom $typeEvent
     *
     * @return PlageHoraire
     */
    public function addTypeEvent(\AppBundle\Entity\EventCustom $typeEvent)
    {
        $this->typeEvent[] = $typeEvent;

        return $this;
    }

    /**
     * Remove typeEvent
     *
     * @param \AppBundle\Entity\EventCustom $typeEvent
     */
    public function removeTypeEvent(\AppBundle\Entity\EventCustom $typeEvent)
    {
        $this->typeEvent->removeElement($typeEvent);
    }

    /**
     * Get typeEvent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypeEvent()
    {
        return $this->typeEvent;
    }
}
