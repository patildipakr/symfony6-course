<?php
namespace App\Service;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RouteUrlGenerate
{
    /**
     * 
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;        
    }
    
    public function getUrl(string $routeName):?string {
        return $this->urlGenerator->generate('app_blog_about_us');
    }
}

