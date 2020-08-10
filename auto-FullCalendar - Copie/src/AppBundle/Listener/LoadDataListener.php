<?php
use AncaRebeca\FullCalendarBundle\Model\Event;
use AppBundle\Entity\EventCustom as MyCustomEvent;

class LoadDataListener
{
    /**
     * @param EventCustom $calendarEvent
     *
     * @return FullCalendarEvent[]
     */
    public function loadData(EventCustom $calendarEvent)
    {
    	 $startDate = $calendarEvent->getStart();
   		 $endDate = $calendarEvent->getEnd();
		 $filters = $calendarEvent->getFilters();
	
    	 //You may want do a custom query to populate the events
    	 
    	 $calendarEvent->addEvent(new MyCustomEvent('Event Title 1', new \DateTime()));
    	 $calendarEvent->addEvent(new MyCustomEvent('Event Title 2', new \DateTime()));
    }
}