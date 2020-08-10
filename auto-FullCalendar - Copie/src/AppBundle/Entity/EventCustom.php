<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use AncaRebeca\FullCalendarBundle\Event\CalendarEvent as FullCalendarEvent;
 
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;


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
}

