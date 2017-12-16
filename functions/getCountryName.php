<?php


    // TODO: it can also return boolean
    /**
     * Return country name in English for ISO 3166-1 alpha-2 code.
     * 
     * @param string $countryCode
     * @return string
     */
    function getCountryName(string $countryCode) {
        $dataFileLocation = __DIR__ . "/../data/country.io-names.json";

        $dataFileContents = file_get_contents($dataFileLocation);
        $jsonData = json_decode($dataFileContents, TRUE);

        if(!empty($jsonData[$countryCode])) {
            return $jsonData[$countryCode];
        } else {
            // TODO: Return error "country not found"
            return false;
        }
    }