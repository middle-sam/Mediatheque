<?php
namespace App\Service;

use App\Entity\MeetUp;
use App\Entity\Participates;
use App\Repository\ParticipatesRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MeetupManager extends AbstractExtension
{


    public $meetUpId;
    public $participatesRepository;

    //$sumByMeetUp = new \Twig\Environment($loader);
    //$sumByMeetUp->addGlobal('text', new Text());

    public function __construct(ParticipatesRepository $participatesRepository)
    {
        $this->participatesRepository = $participatesRepository;
    }

    public function getFilters()
    {
        //$queryResult = $this->participatesRepository->sumOfPlacesByMeetup(12);
        return [
            new TwigFilter('sumOfPlacesByMeetup', [$this, 'formatSumOfPlaces']),
        ];
    }

    public function formatSumOfPlaces(MeetUp $meetUpID){

        return $this->participatesRepository->sumOfPlacesByMeetup($meetUpID)[0][1];

    }

}
