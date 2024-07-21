<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Message\NotifyArticleMessage;

#[AsCommand(
    name: 'app:notify-blog',
    description: 'Add a short description for your command',
)]
class NotifyBlogCommand extends Command
{
    /**
     * 
     * @var MessageBusInterface
     */
    private $messageBus;
    
    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
        
        parent::__construct();
    }

    protected function configure(): void
    {
       
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        $this->messageBus->dispatch(new NotifyArticleMessage(21));
        
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
