<?php

namespace AppBundle\Entity;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AncaRebeca\FullCalendarBundle\Model\Event as FullCalendarEvent;
/**
 * EventCustom
 *
 * @ORM\Table(name="event_custom")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventCustomRepository")
 */
class EventCustom extends FullCalendarEvent
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PlageHoraire",inversedBy="typeEvent",cascade={"merge","persist","DETACH"})
     *@ORM\joinColumn(onDelete="SET NULL")
     */
    protected $title;
    /**
     * @var boolean
     * @ORM\Column(type="boolean", name="allDay", nullable=true)
     */
    protected $allDay = false;
    //     * @Assert\GreaterThanOrEqual("now")
    
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="start",unique=true)
     */
    protected $startDate;
   // * @Assert\GreaterThan("now")
    
     /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="end")  
     */

      //@Assert\DateTime()

    protected $endDate;
    /**
     * @var array
     * @ORM\Column(type="array",name="filters", nullable=true) 
     */
    protected $filters;
    /**
     * @var string
     * @ORM\Column(type="string",name="url", nullable=true) 
     */
    protected $url;
    /**
     * @var string
     * @ORM\Column(type="string",name="className", nullable=true) 
     */
    protected $className;
    /**
     * @var boolean
     * @ORM\Column(type="boolean",name="editable", nullable=true) 
     */
    protected $editable = false;
    /**
     * @var boolean
     * @ORM\Column(type="boolean",name="startEditable", nullable=true) 
     */
    protected $startEditable = false;
    /**
     * @var boolean
     * @ORM\Column(type="boolean",name="durationEditable", nullable=true) 
     */
    protected $durationEditable = false;
    /**
     * @var string
     * @ORM\Column(type="string",name="rendering", nullable=true) 
     */
    protected $rendering;
    /**
     * @var boolean
     * @ORM\Column(type="boolean",name="overlap", nullable=true) 
     */
    protected $overlap = true;
    /**
     * @var integer
     * @ORM\Column(type="integer",name="constraints", nullable=true) 
     */
    protected $constraint;
    /**
     * @var string
     * @ORM\Column(type="string",name="source", nullable=true) 
     */
    protected $source;
    /**
     * @var string
     * @ORM\Column(type="string",name="color", nullable=true) 
     */
    protected $color;
    /**
     * @var string
     * @ORM\Column(type="string",name="backgroundColor", nullable=true) 
     */
    protected $backgroundColor;
    /**
     * @var string
     * @ORM\Column(type="string",name="textColor", nullable=true) 
     */
    protected $textColor;
    /**
     * @var array
     * @ORM\Column(type="array",name="events", nullable=true) 
     */
    protected $events;
    /**
     * @var boolean
     * @ORM\Column(type="boolean",name="visible",options={"default"=1}) 
     */
    protected $visible=true;
    
    /**
     * @var boolean
     * @ORM\Column(type="boolean",name="valider",options={"default"=0}) 
     */
    protected $valider=false;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="eleve", cascade={"merge","persist"})
     */
    protected $rdv;
    public function __construct($title=null, $startDate=null)
    {
    	$this->title = new \Doctrine\Common\Collections\ArrayCollection();
        $this->startDate = $startDate = new \DateTime('now');

        //$interval = new DateInterval('P1M');
        $this->endDate = $endDate= new \DateTime('now');
        $customFields=new \Doctrine\Common\Collections\ArrayCollection();
        $this->allDay=false;
        $this->events=new \Doctrine\Common\Collections\ArrayCollection();

        parent::__construct($title,$startDate,$endDate);

        // your own logic


    }

    
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
     * Set nom
     *
     * @param string $nom
     *
     * @return EventCustom
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
     * Set title
     *
     * @param string $title
     *
     * @return EventCustom
     */
    public function setTitle($title)
    {
    	$this->title = $title;
    	
    	return $this;
    }
    
    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
    	return $this->title;
    }
    
    /**
     * Get allDay
     *
     * @return boolean
     */
    public function getAllDay()
    {
        return $this->allDay;
    }

    /**
     * Set filters
     *
     * @param array $filters
     *
     * @return EventCustom
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;

        return $this;
    }

    /**
     * Get filters
     *
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * Get editable
     *
     * @return boolean
     */
    public function getEditable()
    {
        return $this->editable;
    }

    /**
     * Get startEditable
     *
     * @return boolean
     */
    public function getStartEditable()
    {
        return $this->startEditable;
    }

    /**
     * Get durationEditable
     *
     * @return boolean
     */
    public function getDurationEditable()
    {
        return $this->durationEditable;
    }

    /**
     * Get overlap
     *
     * @return boolean
     */
    public function getOverlap()
    {
        return $this->overlap;
    }

    /**
     * Set events
     *
     * @param array $events
     *
     * @return EventCustom
     */
    public function setEvents($events)
    {
        $this->events = $events;

        return $this;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     *
     * @return EventCustom
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
     * Set valider
     *
     * @param boolean $valider
     *
     * @return EventCustom
     */
    public function setValider($valider)
    {
        $this->valider = $valider;

        return $this;
    }

    /**
     * Get valider
     *
     * @return boolean
     */
    public function getValider()
    {
        return $this->valider;
    }

    

    /**
     * Set rdv
     *
     * @param \UserBundle\Entity\User $rdv
     *
     * @return EventCustom
     */
    public function setRdv(\UserBundle\Entity\User $rdv = null)
    {
        $this->rdv = $rdv;

        return $this;
    }

    /**
     * Get rdv
     *
     * @return \UserBundle\Entity\User
     */
    public function getRdv()
    {
        return $this->rdv;
    }
}
