<?php

namespace OpenKvk\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use OpenKvk\Client as OpenKvkClient;

class GetBySbiCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('openkvk:getbysbi')
            ->setDescription('Test request')
            ->addArgument(
                'sbi',
                InputArgument::REQUIRED,
                'SBI'
            )
            ->addOption(
                'format',
                null,
                InputOption::VALUE_REQUIRED,
                'Format'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sbi = $input->getArgument('sbi');
        $client = new OpenKvkClient();
        $format = $input->getOption('format');
        if ($format!='') {
            $client->setResponseFormat($format);
        }
        $data = $client->getBySbi($sbi);
        echo $data;
        //echo "Results: " . count($data) . "\n";
        return;
    }
}
