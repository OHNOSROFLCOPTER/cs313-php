<?php
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];
    include_once 'database_connect.php';
    $dbconn = get_database_connection();
    $result = pg_prepare($dbconn, "check_existing_name", "SELECT * FROM users WHERE username = $1");
    $result = pg_execute($dbconn, "check_existing_name", [$username]);
    $line = pg_fetch_assoc($result);
    if ($username == $line['username']) {
        $_SESSION['error'] = 'creation';
    }
    else {
        $hashed_pw = password_hash($password, PASSWORD_DEFAULT);
        $result = pg_prepare($dbconn, "create_user", "INSERT INTO users (username, password) VALUES ($1, $2)");
        $result = pg_execute($dbconn, "create_user", [$username, $hashed_pw]);
        $_SESSION['created_user'] = True;
    }
    header('location: index.php');
    
?>
