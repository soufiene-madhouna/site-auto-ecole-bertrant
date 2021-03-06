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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", name="allDay", nullable=true)
     */
    protected $allDay = true;
    
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="start",unique=true, nullable=true)
     * @Assert\GreaterThanOrEqual("now")
     */
    protected $startDate;
     /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="end",unique=true, nullable=true)  
     * @Assert\GreaterThan("now")
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
    
    public function __construct($title=null, $startDate=null)
    {
        $this->title = $title;
        $this->startDate = $dd=$startDate = new \DateTime('now');

        //$interval = new DateInterval('P1M');
        $this->endDate = $endDate= date_sub($dd, date_interval_create_from_date_string('1 hour'));
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
     * Set allDay
     *
     * @param boolean $allDay
     *
     * @return EventCustom
     */
    public function setAllDay($allDay)
    {
        $this->allDay = $allDay;

        return $this;
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
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return EventCustom
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return EventCustom
     */
    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
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
     * Set customFields
     *
     * @param array $customFields
     *
     * @return EventCustom
     */
    public function setCustomFields($customFields)
    {
        $this->customFields = $customFields;

        return $this;
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
     * Set constraint
     *
     * @param integer $constraint
     *
     * @return EventCustom
     */
    public function setConstraint($constraint)
    {
        $this->constraint = $constraint;

        return $this;
    }

    /**
     * Get constraint
     *
     * @return integer
     */
    public function getConstraint()
    {
        return $this->constraint;
    }
}
