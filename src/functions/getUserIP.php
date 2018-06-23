<?php
    function getUserIP() {
        $ipRewrite = new CloudFlare\IpRewrite();

        // return $_SERVER["REMOTE_ADDR"];
        
        return $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
