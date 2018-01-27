<?php
/**
 * Get Mapbox key
 *
 * @return string
 */
function getMapboxKey() {
    $key = getenv("MAPBOX_ACCESS_TOKEN");
    if(empty($key)) {       
        // Load vlucas/phpdotenv and try again
        
        $dotenv = new Dotenv\Dotenv(__DIR__ . "/..");
        $dotenv->load();
        
        $key = getenv("MAPBOX_ACCESS_TOKEN");
        if(empty($key)) {
            die("Mapbox access token not found");
        }
    }
    return $key;
}