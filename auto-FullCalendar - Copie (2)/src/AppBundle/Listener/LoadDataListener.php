<?php
namespace AppBundle\Listener;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Schema\View;

use AncaRebeca\FullCalendarBundle\Model\Event;
use AncaRebeca\FullCalendarBundle\Model\FullCalendarEvent;
use AppBundle\Entity\EventCustom as MyCustomEvent;
use Doctrine\ORM\EntityManager;

class LoadDataListener
{

    private $entityManager;
    
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
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
	
    //ligne rajoute de listener adesginClendar le 26-04-2017
        $request = $calendarEvent->getRequest();
        $filter = $request->get('filter');


        $companyEvents = $this->entityManager->getRepository('AppBundle:EventCustom')
                          ->createQueryBuilder('e')
                          //->where('e.event_datetime BETWEEN :startDate and :endDate')
                          //->setParameter('startDate', $startDate->format('Y-m-d H:i:s'))
                          //->setParameter('endDate', $endDate->format('Y-m-d H:i:s'))
                          ->getQuery()->getResult();

foreach($companyEvents as $companyEvent) {

        // create an event with a start/end time, or an all day event
        if ($companyEvent->getAllDayEvent() === true) {
          $eventEntity = new EventEntity($companyEvent->getTitle(), $companyEvent->getStartDatetime(), $companyEvent->getEndDatetime());
        } else {
          $eventEntity = new EventEntity($companyEvent->getTitle(), $companyEvent->getStartDatetime(), null, true);
        }

        //optional calendar event settings
        $eventEntity->setAllDay(true); // default is false, set to true if this is an all day event
        $eventEntity->setBgColor('#FF0000'); //set the background color of the event's label
        $eventEntity->setFgColor('#FFFFFF'); //set the foreground color of the event's label
        $eventEntity->setUrl('http://www.google.com'); // url to send user to when event label is clicked
        $eventEntity->setCssClass('my-custom-class'); // a custom class you may want to apply to event labels

        //finally, add the event to the CalendarEvent for displaying on the calendar
    /*    $events= $calendarEvent->addEvent($eventEntity);

         $response = new JsonResponse(
         $this->render('full-calendar/load',
                array(
                    'event'=> $events
                )));
    $response->headers->set("content-type", "application/json");
    return $response->getContent();
*/

try {
            $content = $this
                ->get('ancarebeca_full_calendar_load')
                ->getData($startDate, $endDate, $filters);
            $status = empty($content) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;
        } catch (\Exception $exception) {
            $content = json_encode(array('error' => $exception->getMessage()));
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($content);
        $response->setStatusCode($status);

        return $response;



    }


    	 //You may want do a custom query to populate the events
    	 
    	 $calendarEvent->add(new MyCustomEvent('Event Title 8', new \DateTime()));
    	 $calendarEvent->addEvent(new MyCustomEvent('Event Title 2', new \DateTime()));
    }
}