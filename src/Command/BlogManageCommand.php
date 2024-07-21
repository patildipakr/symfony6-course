<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Repository\BlogRepository;
use App\Entity\Blog;
use App\Service\Message;

#[AsCommand(
    name: 'app:blog-manage',
    description: 'This command manage the basic operaiton of blog, like add, archive',
)]
class BlogManageCommand extends Command
{
    /**
     * 
     * @var BlogRepository
     */
    private $blogRepository;
    
    /**
     *
     * @var Message
     */
    private $message;
    
    public function __construct(BlogRepository $blogRepository, Message $message)
    {
        $this->blogRepository = $blogRepository;
        $this->message = $message;
        
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('tag', InputArgument::OPTIONAL, 'Define tag for blog')
            ->addOption('add', null, InputOption::VALUE_NONE, 'Operation to add new blog')
            ->addOption('archive', null, InputOption::VALUE_NONE, 'Operation to archive existing old blog')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('app:blog-manage');
        
        $io->writeln([
            $this->message->getMessage(),
            '',
            '[app:blog-manage] Start at ' . (new \DateTime())->format('Y-m-d H:i:s'),
            '',
            ''
        ]);
        
        $tag = $input->getArgument('tag');

        if ($tag) {
            $output->writeln('Mention tag name is: ' . $tag);
        }

        if ($input->getOption('add')) {
            $io->note('Add option is exist');
            
            $name = $io->ask('Please enter the blog name?', '', function(string $name) {
                if(empty($name)) {
                    throw new \RuntimeException('Blog name should not be blank');
                }
                
                return $name;
            });
            
            $io->writeln(['Blog Name: ' . $name]);
            
            $slug = $io->ask('Please enter the slug?', '', function(string $slug) {
                if(empty($slug)) {
                    throw new \RuntimeException('Slug should not be blank');
                }
                
                return $slug;
            });
                
            $io->writeln(['Slug : ' . $slug]);
            
            $blog = new Blog();
            $blog->setName($name);
            $blog->setSlug($slug);
            
            $this->blogRepository->save($blog, true);
            
            $io->writeln(['Blog Created ID : ' . $blog->getId()]);
        }
        
        if ($input->getOption('archive')) {
            $io->note('Archive option is exist');
        }

        $io->writeln([
            '[app:blog-manage] End at ' . (new \DateTime())->format('Y-m-d H:i:s'),
            '',
            ''
        ]);
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
