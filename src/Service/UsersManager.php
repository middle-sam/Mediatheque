<?php
namespace App\Service;

use App\Entity\MeetUp;
use App\Repository\UserRepository;
use Twig\TwigFilter;

class UsersManager{


    private $users;

    public function __construct(UserRepository $userRepository)
    {
        $this->users = $userRepository;
    }

    public function getFilters()
    {
        //$queryResult = $this->participatesRepository->sumOfPlacesByMeetup(12);
        return [
            new TwigFilter('usersByMeetup', [$this, 'usersByMeetup']),
        ];
    }

    public function usersByMeetup(MeetUp $meetUp){

        return $this->users->findUsersByMeetup($meetUp)[0][1];

    }



}