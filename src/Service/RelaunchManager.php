<?php
namespace App\Service;

use App\Entity\Borrowing;
use App\Repository\BorrowingRepository;
use Symfony\Component\Mailer\MailerInterface;
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
            'première relance'=> "N\'oubliez de nous retourner l'emprunt n°   dès que possible",
            'seconde relance'=>  "Ceci est la seconde relance concernant le document suivant : ",
            'dernière relance'=> "Ceci est la troisème et dernière relance concernant le document suivant : "
        ]
        ;
       // $index = array_rand($messages);
        return $messages;
    }

    public function notify(Borrowing $borrowingEntity)
    {
        //$erd = $contact->expectedReturnDate;
        //$borrowing = new Borrowing;
        $currentDate = new \DateTime();
        $expectedReturnDate= $borrowingEntity->getExpectedReturnDate();
        $interval = $currentDate->diff($expectedReturnDate);



        $customMessages = $this->getBorrowingsMessage();

         $message = (new \Swift_Message('Hello Email'))
                ->setFrom('sami.serbout@gmail.com')
                ->setTo('sami.serbout@gmail.com')
                ->setBody(//'sldijfg','text/html'
                    $this->renderer->render(
                        'emails/relaunchEmail.html.twig',
                        ['member' => $borrowingEntity,
                          'customMessages' => $customMessages,
                        ]
                    ),
                    'text/html'
                );

        $this->mailer->send($message);


        //return $this->render(...);
    }

}

class SiteUpdateManager
{
    private $messageGenerator;
    private $mailer;

    public function __construct(RelaunchManager $messageGenerator, MailerInterface $mailer)
    {
        $this->messageGenerator = $messageGenerator;
        $this->mailer = $mailer;
    }

    public function notifyOfSiteUpdate()
    {
        $happyMessage = $this->messageGenerator->getHappyMessage();

        $email = (new Email())
            ->from('admin@example.com')
            ->to('manager@example.com')
            ->subject('Site update just happened!')
            ->text('Someone just updated the site. We told them: '.$happyMessage);

        $this->mailer->send($email);

        // ...
    }
}