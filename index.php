<?php

if($_SERVER['HTTP_HOST'] == "theel0ja-iplookup.herokuapp.com") {
    header("Location: https://iplookup.theel0ja.info" . $_SERVER['REQUEST_URI']);
    exit();
}

// Libraries
require_once 'vendor/autoload.php';

// Raven for error-reporting
Raven_Autoloader::register();



require_once 'functions/getEnvVariable.php';

/**
 * Return debug mode
 *
 * @return bool
 */
function getDebugMode() {
    $debugMode = false;
    
    $debugModeEnvVar = getEnvVariable("DEBUG_MODE");

    if(!empty($debugModeEnvVar)) {
        if($debugModeEnvVar == "true") {
            $debugMode = true;
        } else {
            $debugMode = false;
        }
    }

    return $debugMode;
}

if(!getDebugMode()) {
    $client = new Raven_Client('https://87c404ea730a4a0cb596ca0caec20bbb:8113f293c7844edd9ed206131468310c@sentry.io/942255');

    $client->install();
}

// Functions
require_once 'functions/getCountryName.php';
require_once 'functions/getParameters.php';
require_once 'functions/getMapboxKey.php'; // Needs getEnvVariable
require_once 'functions/getUserIP.php';
require_once 'functions/getTimezoneByPosition.php';
require_once 'functions/getContinentByCountryCode.php';
require_once 'functions/getIPAddressFromDNS.php';

/**
 * Return project's name
 *
 * @return string
 */
function getProjectName() {
    return "IPLookup";
}

// Load Twig
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
//    'cache' => 'cache',
    'debug' => getDebugMode() // TODO: Environmental variable should set this
));

if (empty($_GET["host"]) && empty($_GET["ip"])) {
    // Show default view
    $params = getParameters(getUserIP());
} else {
    // Show default view with some parameters
    if(!empty($_GET["host"]) && empty($_GET["ip"])) {
        if(filter_var($_GET["host"], FILTER_VALIDATE_IP) !== false) {
            // Query parameter is IP address
            $params = getParameters($_GET["host"]);
        } else {
            // Query parameter is hostname, do host lookup
            
            // TODO: validate $_GET["host"]
            $ipv4Address = getIPAddressFromDNS($_GET["host"], false);

            if(!$ipv4Address) {
                die('No IPv4 address found for the hostname');
            }

            $params = getParameters($ipv4Address);
        }
    }

    // Validate $_GET["ip"]
    if(!empty($_GET["ip"]) && filter_var($_GET["ip"], FILTER_VALIDATE_IP) !== false) {
        $params = getParameters($_GET["ip"]);
    }
}


$params["mapbox_key"] = getMapboxKey();
$params["project_name"] = getProjectName();
$params["debug_mode"] = getDebugMode();

if($params["error"] != "bogon") {
    $params["country_name"] = getCountryName($params["country"]);
    $params["local_time"] = getTimezoneByPosition($params["lat"], $params["lng"]);
    $params["continent"] = getContinentByCountryCode($params["country"]);
}

echo $twig->render('index.html.twig', $params);