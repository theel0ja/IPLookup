<?php

    /**
     * ipinfo.io client
     *
     * @param string $ipAddress
     * @return array
     */
    function ipinfoClient($ipAddress) {
        $json = file_get_contents("http://ipinfo.io/{$ipAddress}");
        $details = json_decode($json, true);
        return $details;
    }

    /**
     * Return country name in English for ISO 3166-1 alpha-2 code.
     * 
     * @param string $ipAddress
     * @return array
     */
    function getParameters(string $ipAddress) {
        if(filter_var($ipAddress, FILTER_VALIDATE_IP) !== false) {
            $params = array();
            $params["ip"] = $ipAddress;

            $ipinfoData = ipinfoClient($params["ip"]);

            //print_r($ipinfoData);

            //TODO: if($ipinfo["bogon"] === 1) -> SHOW ERROR!
            
            // Some parameters
            //$params["hostname"] = gethostbyaddr($params["ip"]);
            $params["hostname"] = $ipinfoData["hostname"];
            $params["asn"] = preg_replace('/\D/', '', explode(" ", $ipinfoData["org"])[0]);
            $params["isp"] = str_replace(
                explode(" ", $ipinfoData["org"])[0],
                "",
                $ipinfoData["org"]
            );
            $params["city"] = $ipinfoData["city"];
            $params["region"] = $ipinfoData["region"];
            $params["country"] = $ipinfoData["country"];
            
            // Location
            $params["lat"] = explode(",", $ipinfoData["loc"])[0];
            $params["lon"] = explode(",", $ipinfoData["loc"])[1];

            return $params;
        } else {
            // TODO: throw error
            return false;
        }
    }