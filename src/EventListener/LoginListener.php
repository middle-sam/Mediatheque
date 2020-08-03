<?php


namespace App\EventListener;

use App\Entity\User;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Controller\ErrorController;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use App\Controller\SecurityController;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;

class LoginListener
{
    public $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


    ///**
    // * @param ControllerEvent $event
    // * @param AuthenticationEvent $authenticationEvent
    // */
    //public function onKernelController(ControllerEvent $event, $authenticationEvent)
    //{
    //    //on doit récupérer le contrôleur qui a été appelé par l'event $event->getController()
    //    // si l'url du contrôleur appelé correspond à la route du login on inscrit cela dans un fichier l'id et le pass du user concerné.
    //    //utiliser monolog afin de stocker les données dans un fichier de log : $logger->info($message) =  si on récupère un service de type logger on execute l'ériture du log
    //    //checker dans var si le log a été inscrit
//
    //    // the controller can be changed to any PHP callable
    //    //$event->setController($myCustomController);
//
    //    //$request = $request->attributes->get('user');
//
    //    //controleur appelé
    //    $controller =$event->getController();
//
    //    //requête correspondant au login
    //    $request = $event->getRequest();
//
    //    //type de la méthode
    //    $requestType = $event->getRequest()->getPathInfo();
//
    //    $user = $authenticationEvent->getAuthenticationToken()->getUser();
//
    //    //var_dump($requestType);die;
    //    //var_dump(get_class($controller[0]));die;
//
    //    //si la le controller est de type securityController on lance l'écriture du log via monolog
    //    if($authenticationEvent){
    //        echo $user->getFirstName();
    //        die;
    //    }else{
    //        echo 'ko';
    //        die;
    //    }
//
    //}

    public function onSecurityAuthenticationSuccess(AuthenticationEvent $event) {
        $user = $event->getAuthenticationToken()->getUser();

        //if ($user instanceof User) {
        //    echo $user->getFirstName();
        //    echo "</br>";
        //    echo $user->getPassword();
        //    die;
        //}
        if($user instanceof User){

            $this->logger->info('Connexion: '.$user->getEmail().":".$user->getPassword());
        }

    }

}