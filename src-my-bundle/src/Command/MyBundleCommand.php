<?php

namespace Cerad\MyBundle\Command;

use Cerad\MyBundle\Service\UpdateService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'my:bundle',
    description: 'Add a short description for your command',
)]
class MyBundleCommand extends Command
{
    public function __construct(private UpdateService $updateService)
    {
        parent::__construct();
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->success('MyBundle');

        $this->updateService->doit();
        
        return Command::SUCCESS;
    }
}
