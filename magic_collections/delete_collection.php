<?php
session_start();
$collection_id = $_GET['c_id'];
$user_id = $_SESSION['id'];
include_once 'database_connect.php';
$dbconn = get_database_connection();
//This is just to make sure another user isn't trying to delete another user's collection
$query = "SELECT id FROM collections WHERE collections.id = $1 AND collections.user_id = $2";
$result = pg_prepare($dbconn, "check_id", $query);
$result = pg_execute($dbconn, "check_id", [$collection_id, $user_id]);
$line = pg_fetch_assoc($result);
if($line['id'] == $collection_id) {
    $query = "DELETE FROM quantity WHERE collection_id = $1";
    $result = pg_prepare($dbconn, "delete_col_cards", $query);
    $result = pg_execute($dbconn, "delete_col_cards", [$collection_id]);
    $query = "DELETE FROM collections WHERE id = $1";
    $result = pg_prepare($dbconn, "delete_collection", $query);
    $result = pg_execute($dbconn, "delete_collection", [$collection_id]);
}
header('location: index.php');

?>