<?php
namespace App\Service;

use App\Repository\BorrowingRepository;

class PenaltyManager
{


     public function penaltyCalculator(BorrowingRepository $expiredBorrowings)
    {
        $queryResult = $expiredBorrowings->findOneby(array('id'=>4));
        $date = new \DateTime;
        $interval = date_diff($date, $queryResult->getExpectedReturnDate());
        $diffInWeeks = floor(intval($interval->format('%a')) / 7);

        if ($diffInWeeks < 2) {
                    $penalty = 1 ;
        } elseif ($diffInWeeks > 2 && $diffInWeeks < 4) {
                    $penalty = 2;
        } else {
                    $penalty = 3;
        }

        return $penalty;
        //foreach ($queryResult as $qr) {
//
        //    $penalty = 0;
        //    $interval = date_diff($date, $qr->getExpectedReturnDate());
        //    $diffInWeeks = floor(intval($interval->format('%a')) / 7);
//
//
        //    if ($diffInWeeks < 2) {
        //        $penalty = 1 ;
        //    } elseif ($diffInWeeks > 2 && $diffInWeeks < 4) {
        //        $penalty = 2;
        //    } else {
        //        $penalty = 3;
        //    }
        //}


    }
}

