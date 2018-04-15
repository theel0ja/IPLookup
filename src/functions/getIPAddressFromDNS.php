<?php
    function getIPAddressFromDNS(string $hostname, bool $ipv6) {
        if(!$ipv6) {
            // IPv4
            $ipAddr = gethostbyname($hostname);

            if(filter_var($ipAddr, FILTER_VALIDATE_IP) !== false) {
                return $ipAddr;
            } else {
                return false;
            }
        } else {
            // TODO: IPv6
            return false;
        }
    }