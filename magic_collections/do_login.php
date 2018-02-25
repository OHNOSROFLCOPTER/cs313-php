<?php
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
     //Used to simply grab the database
    include_once 'database_connect.php';
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];
    $dbconn = get_database_connection();
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