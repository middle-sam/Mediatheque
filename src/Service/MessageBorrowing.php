<?php
namespace App\Service;

class MessageBorrowing
{
    public function getBorrowingsMessage()
    {
        $messages = 'Première relance';
            //'Seconde relance',
            //'Troisième relance'


       // $index = array_rand($messages);

        return $messages;
    }
}