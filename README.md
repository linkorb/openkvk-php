# OpenKVK Client library + commandline utility

This repository contains a simple PHP client for the [www.openkvk.nl](http://www.openkvk.nl) API.

## How to use it as a library

Simply include the library through composer:

    "linkorb/openkvk-php": "dev-master"

After this, you can instantiate and use the client as follows:

    // Instantiate the client
    $client = new \OpenKvk\Client();

    // Get data by Kvk nr
    $csv = $client->getByKvk("24365015");

    // Convert into a PHP array
    $data = $client->csvToArray($csv);

    // Output array
    print_r($data); // Outputs array by key/value

## How to use it as a command line utility

The included `bin/openkvk` command is based on the Symfony Console component

Example usage:

    bin/openkvk # output available options
    bin/openkvk openkvk:getbykvk 24365015 # get info by kvk number
    bin/openkvk openkvk:getbysbi 85.59.2 # get info by SBI (85592 = business training and education)

## Resources

* [OpenKVK website](https://openkvk.nl/)
* [SBI Codes - English](http://www.kvk.nl/download/SBI_2008_Engels_tcm14-195658.pdf)
