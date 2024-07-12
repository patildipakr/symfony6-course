<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\Message;
use Psr\Log\LoggerInterface;
use App\Service\Notification;

class ServiceController extends AbstractController
{
    #[Route('/service', name: 'app_service')]
    public function index(
        Notification $notification,
        LoggerInterface $logger
    ): Response
    {
        $messageText = $notification->sendNotification();
        
        //$logger->debug('[ServiceController.index] Message: ' . $messageText);
        
        return $this->render('service/index.html.twig', [
            'messageText' => $messageText
        ]);
    }
}
