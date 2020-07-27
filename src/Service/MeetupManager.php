<?php
namespace App\Service;

use App\Entity\Participates;
use App\Repository\ParticipatesRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MeetupManager extends AbstractExtension
{


    private $meetUpId;
    private $participatesRepository;

    //$sumByMeetUp = new \Twig\Environment($loader);
    //$sumByMeetUp->addGlobal('text', new Text());

    public function __construct(ParticipatesRepository $participatesRepository)
    {
        $this->participatesRepository = $participatesRepository;
    }

    public function getFilters()
    {
        $queryResult = $this->participatesRepository->sumOfPlacesByMeetup(12);
        return [
            new TwigFilter('sumOfPlacesByMeetup', [$this, 'sumOfPlacesByMeetup']),
        ];
    }

}
