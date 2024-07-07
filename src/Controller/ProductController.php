<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(
        Request $request,
        LoggerInterface $logger,
        ParameterBagInterface $parameter
    ): Response
    {
        $apiKey = $parameter->get('email_api_key');
        echo $apiKey;exit;

        $html = $this->renderView('product/email.html.twig', [
            
        ]);
        
        $logger->debug('[ProductController.index] HTML Content: ' . $html);
        
        return $this->render('product/index.html.twig', [
            'html' => $html
        ]);
    }
}
