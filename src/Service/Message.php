<?php
namespace App\Service;

use Psr\Log\LoggerInterface;

class Message
{
    /**
     * 
     * @var LoggerInterface
     */
    private $logger;
    
    public function __construct(
        LoggerInterface $logger
    )
    {
        $this->logger = $logger;
    }
    
    public function getMessage(): string {
        $messageList = [
            "Dear User, Welcome to my channel",
            "Hey Guys, Welcome to my channel",
            "Hi, I am Dipak Patil, Welcome to my channel",
            "Dear Viewer, Welcome to my channel"
        ];
        
        $index = rand(0, count($messageList) - 1);
        
        $message = $messageList[$index];
        
        $this->logger->debug('[Message.getMessage] Message service Pickup Message: ' . $message);
        
        return $message;
    }
}

