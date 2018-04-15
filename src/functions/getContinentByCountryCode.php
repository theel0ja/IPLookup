<?php

    /**
     * Get continent by country code. Answers in English.
     *
     * @param [type] $code
     * @return string
     */
    function getContinentByCountryCode($countryCode): string {
        $dataFileLocation = __DIR__ . "/../data/country.io-continent.json";

        $dataFileContents = file_get_contents($dataFileLocation);
        $jsonData = json_decode($dataFileContents, TRUE);

        if(!empty($jsonData[$countryCode])) {
            $continentCode = $jsonData[$countryCode];
        } else {
            // TODO: Return error "country not found"
            return false;
        }


        $dataFileLocation = __DIR__ . "/../data/opendata.theel0ja.info-continents-english.json";

        $dataFileContents = file_get_contents($dataFileLocation);
        $jsonData = json_decode($dataFileContents, TRUE);

        if(!empty($jsonData[$continentCode])) {
            $continentNameEnglish = $jsonData[$continentCode];

            return $continentNameEnglish;
        } else {
            // Return continentCode
            return $continentCode;
        }
    }