<?php

namespace App\EventListener;


use App\Entity\MeetUp;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * The order.placed event is dispatched each time an order is created
 * in the system.
 */
class MeetUpListener extends Event
{
    public const NAME = 'meetup.created';

    protected $meetUp;

    public function __construct(MeetUp $meetUp)
    {
        $this->meetUp = $meetUp;
    }

    public function getmeetUp()
    {
        return $this->meetUp;
    }

    public function meetUpLog(Event $event)
    {
        // ... do something
    }
}
