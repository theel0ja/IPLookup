<?php
    function getUserIP() {
        $ipRewrite = new CloudFlare\IpRewrite();

        return $_SERVER["REMOTE_ADDR"];
    }