<?php

namespace OpenKvk\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use OpenKvk\Client as OpenKvkClient;

class GetByKvkCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('openkvk:getbykvk')
            ->setDescription('Get info by kvk nr')
            ->addArgument(
                'kvknr',
                InputArgument::REQUIRED,
                'KVK Number'
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
        $kvknr = $input->getArgument('kvknr');
        $client = new OpenKvkClient();
        $format = $input->getOption('format');
        if ($format!='') {
            $client->setResponseFormat($format);
        }
        $data = $client->getByKvk($kvknr);
        echo($data);
        //echo "Results: " . count($data) . "\n";
        return;
    }
}
