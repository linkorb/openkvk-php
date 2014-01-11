<?php

namespace OpenKvk;


class Client
{
    private $responseFormat = 'csv';
    private $baseurl = 'http://api.openkvk.nl';

    public function setResponseFormat($format)
    {
        $format = strtolower($format);
        switch ($format) {
            case 'csv':
            case 'php':
            case 'json':
            case 'py':
            case 'ruby':
                $this->responseFormat = $format;
                break;
        }
    }

    public function doQuery($query, $format = null)
    {
        $query = str_replace("\n", " ", $query);
        if (!$format) {
            $format = $this->responseFormat;
        }

        $url = $this->baseurl . '/' . $format . '/' . rawurlencode($query);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public function getByKvk($kvknr)
    {
        $data = $this->doQuery(sprintf("SELECT * FROM kvk WHERE kvks = '%s' LIMIT 1;", $kvknr));
        return $data;
    }

    public function getByName($name)
    {
        $name=strtolower($name);
        $data = $this->doQuery(sprintf("SELECT * FROM kvk WHERE LOWER(bedrijfsnaam) LIKE '%%%s%%' LIMIT 1;", $name));
        return $data;
    }

    public function getBySbi($sbi)
    {
        $data = $this->doQuery(
            sprintf(
                "SELECT * FROM kvk 
                JOIN kvk_sbi ON kvk_sbi.kvk = kvk.kvk
                WHERE code = '%s'
                AND isnull(status);"
                , $sbi
            )
        );
        return $data;
    }

    public function csvToArray($csv)
    {
        $lines = explode("\n", $csv);
        $head = str_getcsv(array_shift($lines), ',', '"');
        $array = array();
        foreach ($lines as $line) {
            if (trim($line)!='') {
                $array[] = array_combine($head, str_getcsv($line));
            }
        }
        return $array;
    }
 }