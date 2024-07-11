<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\AppExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('current_date', [$this, 'date']),
        ];
    }
    
    public function date() : string {
        $currentTime = new \DateTime();
        return $currentTime->format('d M Y H:i:s');
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('current_date_fn', [$this, 'date']),
        ];
    }
}
