<?php
if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) {
    http_response_code(404);
    die();
}

function get_database_connection() {
    $app_type = parse_ini_file('mc_config.ini')['database'];
    $connection = NULL;
    if ($app_type == 'heroku') {
        $dbUrl = getenv('DATABASE_URL');
        $dbopts = parse_url($dbUrl);
        $dbHost = $dbopts['host'];
        $dbPort = $dbopts['port'];
        $dbUser = $dbopts['user'];
        $dbPassword = $dbopts['pass'];
        $dbName = ltrim($dbopts['path'],'/');
        $connection = pg_connect("host=$dbHost port=$dbPort dbname=$dbName user=$dbUser password=$dbPassword");
    }
    else {
        //Ordinarily, I would keep these credentials in the mc_config.ini file but
        //whatever.  ¯\_(ツ)_/¯
        $connection = pg_connect("host=localhost dbname=magic_db user=wwillden password=''");
    }
    return $connection;
}
?>