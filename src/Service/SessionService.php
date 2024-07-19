<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class SessionService
{

    /**
     * @var RequestStack
     */
    private $requestStack;
    public function __construct(
        RequestStack $requestStack
    )
    {
        $this->requestStack = $requestStack;
    }
    
    public function set(string $key, $value): SessionService {
        $session = $this->requestStack->getCurrentRequest()->getSession();
        $session->set($key, $value);
        
        return $this;
    }
    
    public function get(string $key, $default = null) {
        $session = $this->requestStack->getCurrentRequest()->getSession();
        return $session->get($key, $default);
    }
}

