<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\SessionService;
use App\Service\Message;

class TestSessionController extends AbstractController
{
    #[Route('/test/session', name: 'app_test_session')]
    public function index(
        Request $request,
        SessionService $sessionService
    ): Response
    {
        
        $randomNumber = $request->getSession()->get('random_number', '');
        $randomNumber = $sessionService->get('random_number', '');
        
        //$sessionAttributes = $session->all();
        //dd($sessionAttributes);
        
        return $this->render('test_session/index.html.twig', [
            'randomNumber' => $randomNumber
        ]);
    }
    
    
    #[Route('/test/session2', name: 'app_test_session2')]
    public function index2(
        Request $request,
        SessionService $sessionService,
        Message $message
    ): Response
    {
        $request->getSession()->set('random_number', rand(999, 9999));
        $sessionService->set('random_number', rand(999, 9999));
        
        $this->addFlash('success', $message->getMessage());
        
        return $this->redirectToRoute('app_test_session');
    }
}
