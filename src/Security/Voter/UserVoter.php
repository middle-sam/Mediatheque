<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class  UserVoter extends Voter
{
    const EDIT = 'EDIT';
    const NEW = 'NEW';
    const DELETE = 'DELETE';

    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::EDIT, self::DELETE, self::NEW])
            && $subject instanceof \App\Entity\User;
    }

    protected function voteOnAttribute($attribute, $user , TokenInterface $token)
    {
        $authenticatedUser = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$authenticatedUser instanceof UserInterface) {
            return false;
        }


        switch ($attribute) {
            case 'EDIT':
                return  $authenticatedUser->getId() == 107;
                break;
            case 'DELETE':
                return  $authenticatedUser->getId() == 107;
                break;
            case 'NEW' :
                return  $authenticatedUser->getId() == 107;
                break;
        }

        return false;
    }
}
