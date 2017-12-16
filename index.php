<?php

require_once 'vendor/autoload.php';

// Load Twig
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'cache' => 'cache',
    'debug' => true // Environmental variable should set this
));

if (empty($_GET["host"]) && empty($_GET["ip"])) {
    // Show default view

    echo $twig->render('index.html.twig');
} else {
    // Show default view with some parameters

    $params = array();

    // TODO: Validate $params["host"]
    if(!empty($_GET["host"])) {
        //$params["host"] = $_GET["host"];
    }

    // Validate $params["ip"]
    if(!empty($_GET["ip"]) && filter_var($_GET["ip"], FILTER_VALIDATE_IP) !== false) {
        $params["ip"] = $_GET["ip"];
        
        // Some parameters
        $params["hostname"] = gethostbyaddr($params["ip"]); // TODO: validate
        $params["asn"] = 15169;
        $params["isp"] = "Google LLC";
        $params["city"] = "Mountain View";
        $params["region"] = "California";
        $params["country"] = "US";

        // Location
        $params["lat"] = 37.3860;
        $params["lon"] = -122.0840;

        echo $twig->render('index.html.twig', $params);
    }
}