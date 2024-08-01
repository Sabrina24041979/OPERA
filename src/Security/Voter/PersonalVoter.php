<?php

namespace App\Security\Voter;

use DateTime;
use Exception;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class PersonalVoter extends Voter
{
    public const ACCESS = 'BLOCKED';

    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::ACCESS]);
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $personal = $token->getUser();


        // si aucun utilisateur reconnu, ne pas garantir l'accès
        if (!$personal instanceof UserInterface) {
            return false;
        }



        if ($attribute == self::ACCESS) {
            // Prendre la date de la derniere modification
            $lastUpdatedPassword = $personal->getLastUpdatedPassword();

            if ($lastUpdatedPassword === null) { // Si l'utilisateur n'a pas modifié son modifié son mode de passe au moins une fois alors le bloquer
                return false; // Si on veut bloquer l'utilisateur si le mot de passe n'a jamais été modifié, mettre "return true"
            }

            $target = clone $lastUpdatedPassword; // Cloner la dernière date de mise à jour
            // Ajouter 90 à la date de derniere modifiation
            $target->add(new \DateInterval('P90D'));

            $now = new DateTime(); // Date du jour

            // Si la date modifiée est inférieur à la date du jour, alors bloquer le compte
            if ($target < $now) {
                return true;
            }
            return false;
        }

        throw new Exception('Attribut non trouvé');
    }
}
