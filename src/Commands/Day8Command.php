<?php
namespace Console\Commands;
 
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use Console\Utils\AocDay8;

 
class Day8Command extends Command
{

    protected function configure()
    {
        $this->setName('day8')
             ->setDescription('Run only Advent of Code 2015 Day 8')
             ->setHelp('Add filename attribute if you want custom input data.'.PHP_EOL.' Example: php bin/console day8 [filename=8_input.txt]')
             ->addArgument('filename', InputArgument::OPTIONAL, 'Please upload the custom input data to public folder.');
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        // Result
        $io->section('Advent of Code 2015 - Day 8'.PHP_EOL);
        
        $result = new AocDay8( '8_input.txt' );
        
        $io->text('PART I result: '.$result->getPartI().PHP_EOL);
        $io->text('PART II result: '.$result->getPartII().PHP_EOL);
        
    }
}