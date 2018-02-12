<?php

session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];
    $dbUrl = getenv('DATABASE_URL');
    $dbopts = parse_url($dbUrl);

    $dbHost = $dbopts['host'];
    $dbPort = $dbopts['port'];
    $dbUser = $dbopts['user'];
    $dbPassword = $dbopts['pass'];
    $dbName = ltrim($dbopts['path'],'/');
    $dbconn = pg_connect("host=$dbHost port=$dbPort dbname=$dbName user=$dbUser password=$dbPassword");
    $result = pg_prepare($dbconn, "check_creds", "SELECT * FROM users WHERE username = $1");
    $result = pg_execute($dbconn, "check_creds", [$input_username]);
    $line = pg_fetch_assoc($result);
//uncomment this when we can insert       if (password_verify($input_password, $result['password'])) {
    if ($input_password == $line['password']) {
        unset($_SESSION['error']);
        $_SESSION['username'] = $line['username'];
        $_SESSION['display_name'] = $line['display_name'];
        $_SESSION['id'] = $line['id'];          
    }

    else {
        $_SESSION['error'] = True;
    }
}

else {
    $_SESSION['error'] = True;
}

header('Location: index.php');

?>