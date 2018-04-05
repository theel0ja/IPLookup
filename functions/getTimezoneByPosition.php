<?php

    /**
     * Get timezone by position
     *
     * @param [string] $lat
     * @param [string] $lng
     * @return string
     */
    function getTimezoneByPosition($lat, $lng): string {
        $url = "https://api.timezonedb.com/v2/get-time-zone?key=" . getEnvVariable("TIMEZONEDB_KEY") . "&format=json&by=position&lat=" . $lat . "&lng=" . $lng;

        $raw_data = file_get_contents($url);

        $data = json_decode($raw_data, true);

        if($data["status"] != "OK") {
            throw new Error("Timezone lookup status not 'OK'");
        }

        return $data["formatted"] . " " . $data["abbreviation"]; // "2018-04-05 17:14:14 CEST"
    }
