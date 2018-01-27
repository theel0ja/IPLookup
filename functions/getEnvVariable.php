<?php
/**
 * Get environmental variable
 *
 * @param string $variable_name
 * @return string
 */
function getEnvVariable(string $variable_name) {
    $variable_contents = getenv($variable_name);

    if(empty($variable_contents)) {       
        // Load vlucas/phpdotenv and try again
        
        $dotenv = new Dotenv\Dotenv(__DIR__ . "/..");
        $dotenv->load();
        
        $variable_contents = getenv($variable_name);
        if(empty($variable_contents)) {
            die("Environmental variable $variable_name not found");
        }
    }

    return $variable_contents;
}