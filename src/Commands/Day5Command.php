<?php
namespace Console\Commands;
 
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use Console\Utils\AocDay5;

 
class Day5Command extends Command
{

    protected function configure()
    {
        $this->setName('day5')
             ->setDescription('Run only Advent of Code 2015 Day 5')
             ->setHelp('Add filename attribute if you want custom input data.'.PHP_EOL.' Example: php bin/console day5 [filename=5_input.txt]')
             ->addArgument('filename', InputArgument::OPTIONAL, 'Please upload the custom input data to public folder.');
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        // Result
        $io->section('Advent of Code 2015 - Day 5'.PHP_EOL);
        
        $result = new AocDay5( '5_input.txt' );
        
        $io->text('PART I result: '.$result->getPartI().PHP_EOL);
        $io->text('PART II result: '.$result->getPartII().PHP_EOL);
        
    }
}