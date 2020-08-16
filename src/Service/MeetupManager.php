<?php
namespace App\Service;

use App\Entity\MeetUp;
use App\Repository\ParticipatesRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MeetupManager extends AbstractExtension
{


    public $participatesRepository;

    //$sumByMeetUp = new \Twig\Environment($loader);
    //$sumByMeetUp->addGlobal('text', new Text());

    public function __construct(ParticipatesRepository $participatesRepository)
    {
        $this->participatesRepository = $participatesRepository;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('sumOfPlacesByMeetup', [$this, 'formatSumOfPlaces']),
        ];
    }

    public function formatSumOfPlaces(MeetUp $meetUp){

        return $this->participatesRepository->sumOfPlacesByMeetup($meetUp)[0][1];

    }


}
