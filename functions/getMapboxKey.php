<?php
/**
 * Get Mapbox key
 *
 * @return string
 */
function getMapboxKey() {
    $key = getEnvVariable('MAPBOX_ACCESS_TOKEN');
    return $key;
}