<?php
namespace App\Service;

use App\Service\Message;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class Notification
{
    /**
     * 
     * @var Message
     */
    private $message;
    
    /**
     * 
     * @var LoggerInterface
     */
    private $logger;
    
    /**
     * 
     * @var string
     */
    private $uploadPath;
    
    /**
     * 
     * @var ParameterBagInterface
     */
    private $parameter;
    
    public function __construct(
        Message $message,
        LoggerInterface $logger,
        ParameterBagInterface $parameter,
        string $uploadPath = ''
    )
    {
        $this->message = $message;
        $this->logger = $logger;
        $this->parameter = $parameter;
    }
    
    public function sendNotification():string {
        $messageContent = $this->message->getMessage();
        
        $messageContent .= " => " . $this->uploadPath;
        
        $apiKey = $this->parameter->get('email_api_key');
        $this->logger->debug('[Notification.sendNotification] API key to use to send notification: ' . $apiKey);
        
        $uploadPath = $this->parameter->get('upload_path');
        $this->logger->debug('[Notification.sendNotification] Upload Path is: ' . $uploadPath);
        
        //code to send message by SMS or Email or any Channel by API
        
        $this->logger->debug('[Notification.sendNotification] Notification send successfully and file send successfully form path: ' . $this->uploadPath);
        
        return $messageContent;
    }
}

