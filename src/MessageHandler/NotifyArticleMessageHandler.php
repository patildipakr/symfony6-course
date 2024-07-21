<?php

namespace App\MessageHandler;

use App\Message\NotifyArticleMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Psr\Log\LoggerInterface;
use App\Entity\Blog;
use App\Repository\BlogRepository;

#[AsMessageHandler]
final class NotifyArticleMessageHandler
{
    /**
     * 
     * @var BlogRepository
     */
    private $blogRepository;
    
    /**
     * 
     * @var LoggerInterface
     */
    private $logger;
    
    public function __construct(
        BlogRepository $blogRepository,
        LoggerInterface $logger
    ) {
        $this->blogRepository = $blogRepository;
        $this->logger = $logger;
    }
    
    public function __invoke(NotifyArticleMessage $message): void
    {
        if(empty($message->getBlogId())) {
            $this->logger->error('Zero or null blog id provided.');
            return;
        }
        
        $blog = $this->blogRepository->find($message->getBlogId());
        if(!$blog instanceof Blog) {
            $this->logger->error('Blog not found or invalid blog id provided');
            return;
        }
        
        $this->logger->debug('[BLOG] ID: ' . $blog->getId() . ', Name: ' . $blog->getName());
    }
}
