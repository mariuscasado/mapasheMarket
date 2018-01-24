<?php

namespace Mapashe;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class ProcessCommand extends Command
{
    /** @var PriceCalculator */
    private $priceCalculator;

    protected function configure()
    {
        $this->setName('mapashe:process');
        $this->priceCalculator = new PriceCalculator();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        do {
            $helper = $this->getHelper('question');
            $question = new Question('Input: ', 'AcmeDemoBundle');

            $e = $helper->ask($input, $output, $question);

            $this->priceCalculator->processElements($e);

            $output->writeln("\t" . $this->priceCalculator->getTotal());

        } while (true);
    }
}
