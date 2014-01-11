<?php

namespace OpenKvk\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use OpenKvk\Client as OpenKvkClient;

class GetByNameCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('openkvk:getbyname')
            ->setDescription('Get info by company name')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Company name'
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
        $name = $input->getArgument('name');
        $client = new OpenKvkClient();
        $format = $input->getOption('format');
        if ($format!='') {
            $client->setResponseFormat($format);
        }
        $data = $client->getByName($name);
        echo $data;
        //echo "Results: " . count($data) . "\n";
        return;
    }
}
