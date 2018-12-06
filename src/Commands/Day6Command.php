<?php
namespace Console\Commands;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\Table;

use Console\Utils\AocDay6;

class Day6Command extends Command
{

    protected function configure()
    {
        $this->setName('day6')
             ->setDescription('Run only Advent of Code 2015 Day 6')
             ->setHelp('Add filename attribute if you want custom input data.'.PHP_EOL.' Example: php bin/console day6 [filename=6_input.txt]')
             ->addArgument('filename', InputArgument::OPTIONAL, 'Please upload the custom input data to public folder.');
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $io = new SymfonyStyle($input, $output);

        // Result
        $io->section('Advent of Code 2015 - Day 6'.PHP_EOL);
        
        $result = new AocDay6( '6_input.txt', 1000, 1000 );
        
        $io->text('PART I result: '.$result->getPartI().PHP_EOL);
        $io->text('PART II result: '.$result->getPartII().PHP_EOL);
        
    }
}