<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BlogRepository;
use App\Entity\Blog;
use Symfony\Component\HttpFoundation\Request;
use App\Service\RouteUrlGenerate;

class BlogController extends AbstractController
{
    
    #[Route('/blog/{id}', name: 'app_blog_details')]
    public function blogDetails(Blog $blog, Request $request, RouteUrlGenerate $routeUrlGenerate): Response
    {
        //Do the code to get blog detail form db based on matching slug
        //$blog = $blogRepository->findOneBy(['slug'=>$slug]);
        
        return $this->render('blog/index.html.twig', [
            "message" => "This is the detail page, My slug is : " . $blog->getName()
        ]);
    }
    
    #[Route('/blog/about-us', name: 'app_blog_about_us', priority: 2)]
    public function aboutUs(): Response
    {
        //Do the code to get blog detail form db based on matching slug
        
        return $this->render('blog/index.html.twig', [
            "message" => "This is about us page"
        ]);
    }
    
    #[Route('/blog', name: 'app_blog')]
    public function index(): Response
    {
        
        return $this->render('blog/index.html.twig', [
        ]);
    }
}
