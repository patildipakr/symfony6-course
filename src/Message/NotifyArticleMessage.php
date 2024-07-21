<?php

namespace App\Message;

final class NotifyArticleMessage
{
    /**
     * 
     * @var int
     */
    private $blogId;
    
    public function __construct(
        int $blogId = 0
    ) {
        $this->blogId = $blogId;
    }
    
    public function getBlogId() : int {
        return $this->blogId;
    }
}
