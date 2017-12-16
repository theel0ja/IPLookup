<?php

require_once 'vendor/autoload.php';
require_once 'functions/getCountryName.php';
require_once 'functions/getParameters.php';

// Load Twig
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'cache' => 'cache',
    'debug' => true // Environmental variable should set this
));

if (empty($_GET["host"]) && empty($_GET["ip"])) {
    // Show default view
    $params = getParameters($_SERVER['REMOTE_ADDR']);
    $params["mapbox_key"] = getenv("MAPBOX_ACCESS_TOKEN");

    echo $twig->render('index.html.twig', $params);
} else {
    // Show default view with some parameters

    if(!empty($_GET["host"])) {
        echo "TODO: Not implemented yet";
    }

    // Validate $_GET["ip"]
    if(!empty($_GET["ip"]) && filter_var($_GET["ip"], FILTER_VALIDATE_IP) !== false) {
        $params = getParameters($_GET["ip"]);
        $params["mapbox_key"] = getenv("MAPBOX_ACCESS_TOKEN");

        echo $twig->render('index.html.twig', $params);
    }
}