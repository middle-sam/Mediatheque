<?php
namespace App\Service;

use App\Entity\Borrowing;
use App\Repository\BorrowingRepository;
use Twig\Environment;

class RelaunchManager
{
    /**
     * @var \swift_mailer
     */
    public $mailer;

    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function getBorrowingsMessage()
    {
       $messages = [
           'première relance'=> 'N\'oubliez pas de restituer votre emprunt...',
           'seconde relance'=> 'Ceci est la seconde et dernière relance...',
           'dernière relance'=> 'Ceci est la troisème et dernière relance, sans retour de votre part dans un délai de 24h.... '
       ]
       ;
       return $messages;
    }

    public function notify(Borrowing $borrowing, BorrowingRepository $expiredBorrowings)
    {
        $queryResult = $expiredBorrowings->findExpiredBorrowingsByMember();
        $date = new \DateTime;
        $messages = [];

        foreach ($queryResult as $qr){

            $interval = date_diff($date, $qr->getExpectedReturnDate());
            $diffInWeeks = floor(intval($interval->format('%a')) / 7);

            if($diffInWeeks<2){
                $messages[$qr->getId()] = $this->getBorrowingsMessage()['première relance'];
            }elseif($diffInWeeks > 2 && $diffInWeeks<4){
                $messages[$qr->getId()] = $this->getBorrowingsMessage()['seconde relance'];
            }else{
                $messages[$qr->getId()] = $this->getBorrowingsMessage()['dernière relance'];
            }

                $message = (new \Swift_Message($borrowing->getMemberId()->getFirstname().' '.$borrowing->getMemberId()->getLastName()))
                    ->setFrom("sami.serbout@gmail.com")
                    ->setTo('sami.serbout@gmail.com')
                    ->setBody(//'sldijfg','text/html'
                        $this->renderer->render(
                            'emails/relaunchEmail.html.twig',
                            [
                                'member' => $borrowing,
                                'messages' => $messages,
                            ]
                        ),
                        'text/html'
                    );

        }
        $this->mailer->send($message);

        //return $this->render(...);
    }

}

