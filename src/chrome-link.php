<?php
    $version = $_GET["v"];
    $ip = $_GET["ip"];
    $host = $_GET["host"];

    if($version === "0.1.0" && $ip == undefined) {
        header("Location: /?host=" . $host . "&chrome_v=" . $version);

        return true;
    }

    echo "Coming soon";