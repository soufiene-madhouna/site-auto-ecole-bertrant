<?php

namespace AgendaCBundle\Entity;

//use Doctrine\ORM\Mapping as ORM;
use BladeTester\CalendarBundle\Entity\EventCategory as BaseEvent;

/**
 * EventCategory
 *
 * @ORM\Table(name="event_category")
 * @ORM\Entity(repositoryClass="AgendaCBundle\Repository\EventCategoryRepository")
 */
class EventCategory extends BaseEvent
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

