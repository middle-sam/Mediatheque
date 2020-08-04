<?php

namespace App\Tests\Service;


use App\Service\PenaltyManager;
use App\Repository\BorrowingRepository;



class PenaltyManagerTest{

    private $expiredBorrowings;

    public function __construct(BorrowingRepository $expiredBorrowings)
    {
        $this->expiredBorrowings = $expiredBorrowings;
    }

    public function testPenaltyCalculator($expiredBorrowings){

        $penality = new PenaltyManager();
        $result =  $penality->penaltyCalculator($expiredBorrowings);

        $this->assertEquals(1, $result);

    }




}