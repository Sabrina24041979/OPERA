<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Scheb\TwoFactorBundle\Security\TwoFactor\QrCode\QrCodeGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class TwoFactorController extends AbstractController
{
    
    /**
    * Je configure la 2FA pour l'utilisateur en générant un QR Code pour TOTP.
    * 
    * @param QrCodeGeneratorInterface $qrCodeGenerator Le générateur de QR Code pour la 2FA.
    * @return Response La réponse HTTP
    */
    #[Route("/2fa/configure", name:"app_configure_2fa")]
    public function configure2fa(QrCodeGeneratorInterface $qrCodeGenerator): Response
    {
        // Je récupère l'utilisateur connecté
        $user = $this->getUser();
        
        // Si aucun utilisateur n'est connecté, je renvoie une erreur d'accès refusé
        if (!$user) {
            throw new AccessDeniedException('Accès refusé, vous devez être connecté.');
        }
        
        // Je vérifie si l'utilisateur a déjà un secret TOTP configuré
        if (null === $user->getTotpAuthenticationSecret()) {
            // Je génère un nouveau secret TOTP pour l'utilisateur
            $secret = $qrCodeGenerator->generateSecret();
            $user->setTotpAuthenticationSecret($secret);
            
            // Je sauvegarde le secret dans la base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        }

        // Je génère le QR Code à partir du secret
        $qrCode = $qrCodeGenerator->getTotpAuthenticationQrCode($user);

        // Je renvoie la vue avec le QR Code en tant que Data URI pour l'affichage
        return $this->render('two_factor/configure.html.twig', [
            'qrCode' => $qrCode->writeDataUri()
        ]);
    }
}
