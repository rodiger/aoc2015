<?php
namespace Console\Commands;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

use Console\Utils\AocDay5;
use Console\Utils\AocDay6;
use Console\Utils\AocDay7;
use Console\Utils\AocDay8;

 
class AocCommand extends Command
{

    protected function configure()
    {
        $this->setName('start')
             ->setDescription('Choose from menu - Advent of Code 2015 Days')
             ->setHelp('Please, choose a day:');             

    } // protected function configure() end
 

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Advent of Code 2015');

        $io->listing(array(
            'Day 5: Doesn\'t He Have Intern-Elves For This?',
            'Day 6: Probably a Fire Hazard',
            'Day 7: Some Assembly Required',
            'Day 8: Matchsticks',
		));

        // Choose the Day        
        $helper = $this->getHelper('question');
        
        $question = new ChoiceQuestion(
            'Please, choose a day:',
            array(
                '5'  => 'Day 5',
                '6'  => 'Day 6',
                '7'  => 'Day 7',
                '8'  => 'Day 8',
                ),
            0
        );

        $question->setErrorMessage('%s is invalid.');

        $day = $helper->ask($input, $output, $question);

        $io->text('You have just selected: '.PHP_EOL.$day.PHP_EOL );


        // Custom file or default?
        $files         = array('Day 5' => '5_input.txt', 'Day 6' => '6_input.txt', 'Day 7' => '7_input.txt', 'Day 8' => '8_input.txt');
        $question_file = new Question('Please enter the name of your own filename or'.PHP_EOL.'leave empty to use default data:'.PHP_EOL, $files[$day]);
        $question_file->setAutocompleterValues($files);

		$question_file->setValidator(function ($answer) {

			if ( !is_file( "public/".$answer ) ) {

				throw new \RuntimeException(
						'The file doesn\'t exists in public folder. Please upload...'
				);

			} // if ( !is_file( "public/".$answer ) ) end

			return $answer;

		});

        $fileName = $helper->ask($input, $output, $question_file);

        $io->text('You have just selected: '.$fileName);

        // Result
        $io->section('Advent of Code 2015 - '.$day.PHP_EOL);
        
        $class_name = 'Console\Utils\Aoc'.preg_replace('/\s+/', '', $day);

        $result     = new $class_name( $fileName );
        
        $io->text('PART I result: '.$result->getPartI().PHP_EOL);
        $io->text('PART II result: '.$result->getPartII().PHP_EOL);
        
    } // protected function execute(InputInterface $input, OutputInterface $output) end
}