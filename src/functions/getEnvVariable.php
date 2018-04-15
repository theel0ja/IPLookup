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
        
        /*
        FIXME: What if .env does not exist (like when you're using Heroku and set only MAPBOX_ACCESS_TOKEN)

        2018-01-27T18:16:43.801747+00:00 app[web.1]: [27-Jan-2018 18:16:43 UTC] PHP Fatal error:  Uncaught Dotenv\Exception\InvalidPathException: Unable to read the environment file at /app/functions/../.env. in /app/vendor/vlucas/phpdotenv/src/Loader.php:75

        2018-01-27T18:16:43.801767+00:00 app[web.1]: Stack trace:

        2018-01-27T18:16:43.801849+00:00 app[web.1]: #0 /app/vendor/vlucas/phpdotenv/src/Loader.php(52): Dotenv\Loader->ensureFileIsReadable()

        2018-01-27T18:16:43.802029+00:00 app[web.1]: #1 /app/vendor/vlucas/phpdotenv/src/Dotenv.php(91): Dotenv\Loader->load()

        2018-01-27T18:16:43.802140+00:00 app[web.1]: #2 /app/vendor/vlucas/phpdotenv/src/Dotenv.php(48): Dotenv\Dotenv->loadData()

        2018-01-27T18:16:43.802236+00:00 app[web.1]: #3 /app/functions/getEnvVariable.php(15): Dotenv\Dotenv->load()

        2018-01-27T18:16:43.802315+00:00 app[web.1]: #4 /app/index.php(29): getEnvVariable('DEBUG_MODE')

        2018-01-27T18:16:43.802379+00:00 app[web.1]: #5 /app/index.php(46): getDebugMode()

        2018-01-27T18:16:43.802409+00:00 app[web.1]: #6 {main}

        2018-01-27T18:16:43.802505+00:00 app[web.1]:   thrown in /app/vendor/vlucas/phpdotenv/src/Loader.php on line 75

        2018-01-27T18:16:43.802720+00:00 app[web.1]: 10.13.46.152 - - [27/Jan/2018:18:16:43 +0000] "GET /?host=g.co HTTP/1.1" 500 - "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0
        */

        $dotenv = new Dotenv\Dotenv(__DIR__ . "/..");
        $dotenv->load();
        
        $variable_contents = getenv($variable_name);
        if(empty($variable_contents)) {
            die("Environmental variable $variable_name not found");
        }
    }

    return $variable_contents;
}