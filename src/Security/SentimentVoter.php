<?php

namespace App\Security;

use App\Entity\EmployeeSentiments;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class SentimentVoter extends Voter
{
    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE = 'delete';

    protected function supports(string $attribute, $subject): bool
    {
        // Utilisez le Voter uniquement pour les attributs VIEW, EDIT, DELETE sur l'entité EmployeeSentiments
        return in_array($attribute, [self::VIEW, self::EDIT, self::DELETE])
            && $subject instanceof EmployeeSentiments;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // Si l'utilisateur n'est pas identifié, refusez l'accès
        if (!$user instanceof UserInterface) {
            return false;
        }

        $sentiment = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($sentiment, $user);
            case self::EDIT:
                return $this->canEdit($sentiment, $user);
            case self::DELETE:
                return $this->canDelete($sentiment, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(EmployeeSentiments $sentiment, UserInterface $user): bool
    {
        // Tout manager peut voir les sentiments
        return $user->hasRole('ROLE_MANAGER');
    }

    private function canEdit(EmployeeSentiments $sentiment, UserInterface $user): bool
    {
        // Les utilisateurs peuvent éditer leurs propres sentiments
        return $user === $sentiment->getPersonal()->getUser();
    }

    private function canDelete(EmployeeSentiments $sentiment, UserInterface $user): bool
    {
        // Suppression réservée aux administrateurs
        return $user->hasRole('ROLE_ADMIN');
    }
}
