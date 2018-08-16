<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DatabaseReloadAllCommand extends Command
{
    protected static $defaultName = 'database:reload:all';

    protected function configure()
    {
        $this
            ->setDescription('Supprime toute la base, la recrée, et injecte les fixtures')
            //->addOption('ws', null, InputOption::VALUE_NONE, 'recharge les agences et les utilisateurs depuis edeal')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $command = $this->getApplication()->find('doctrine:database:drop');
        $arguments = [
            '--force' => true
        ];
        $greetInput = new ArrayInput($arguments);

        $command->run($greetInput, $output);

        $command = $this->getApplication()->find('doctrine:database:create');
        $arguments = [];
        $greetInput = new ArrayInput($arguments);
        $command->run($greetInput, $output);

        $command = $this->getApplication()->find('doctrine:schema:create');
        $arguments = [];
        $greetInput = new ArrayInput($arguments);
        $command->run($greetInput, $output);

        $command = $this->getApplication()->find('doctrine:fixture:load');
        $arguments = [
            '--no-interaction' => true
        ];
        $greetInput = new ArrayInput($arguments);
        $command->run($greetInput, $output);


    }
}
