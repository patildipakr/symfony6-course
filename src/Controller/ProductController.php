<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use App\Entity\Blog;
use App\Service\RouteUrlGenerate;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(
        Request $request,
        LoggerInterface $logger,
        ParameterBagInterface $parameter,
        
    ): Response
    {
        
        $html = $this->renderView('product/email.html.twig', [
            
        ]);
        
        $logger->debug('[ProductController.index] HTML Content: ' . $html);
        
        $this->addFlash('success', 'Product lsit successfully show');
        
        return $this->render('product/index.html.twig', [
            'html' => $html,
            'debug' => false
        ]);
    }
    
    #[Route('/product/1', name: 'app_product_detail')]
    public function productDetail(
        Request $request,
        LoggerInterface $logger,
        ParameterBagInterface $parameter,
        RouteUrlGenerate $routeUrlGenerate
    ): Response
    {
        $stateList = [
            'draft', 'inactive', 'active'
        ];
        
        $product = [];
        $product['name'] = 'Headphone';
        
        $blog1 = [];
        $blog1['slug'] = 'test-article';
        $blog1['title'] = "Test Article";
        
        $blog = new Blog();
        $blog->setSlug('Head-phone-article');
        $blog->setName('Head Phone Article');
        
        return $this->render('product/product_detail.html.twig', [
            'debug' => false,
            'stateList' => $stateList,
            'product' => $product,
            'blog1' => $blog1,
            'blog' => $blog,
            'email' => $routeUrlGenerate->getEmailHtml()
        ]);
    }
}
