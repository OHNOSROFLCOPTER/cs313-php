<?php
session_start();
$username = $_SESSION['username'];
include_once 'database_connect.php';
$dbconn = get_database_connection();
$query = <<<EOT
    INSERT INTO collections (collection_name, user_id)
    VALUES ($1, (SELECT id FROM users WHERE username = $2))
EOT;
$result = pg_prepare($dbconn, "insert_collections", $query);
$result = pg_execute($dbconn, "insert_collections", 
                     [$_POST['collection_name'], $_SESSION['username']]);
header('Location: collections.php');
?>