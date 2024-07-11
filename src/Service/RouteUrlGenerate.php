<?php
namespace App\Service;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class RouteUrlGenerate
{
    /**
     * 
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;
    
    /**
     *
     * @var Environment
     */
    private $twig;

    public function __construct(UrlGeneratorInterface $urlGenerator, Environment $twig)
    {
        $this->urlGenerator = $urlGenerator; 
        $this->twig = $twig;
    }
    
    public function getUrl(string $routeName):?string {
        return $this->urlGenerator->generate('app_blog_about_us');
    }
    
    public function getEmailHtml():string  {
        return $this->twig->render('product/email.html.twig');
    }
}

