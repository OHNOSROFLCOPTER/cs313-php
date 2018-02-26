<?php
session_start();
$quantity_id = $_GET['quantity_id'];
$user_id = $_SESSION['id'];
include_once 'database_connect.php';
$dbconn = get_database_connection();
$query = "SELECT id FROM quantity, collections WHERE collections.id = quantity.collection_id AND quantity.id = $1 AND collections.user_id = $2";
$result = pg_prepare($dbconn, "check_id", $query);
$result = pg_execute($dbconn, "check_id", [$quantity_id, $user_id]);
$line = pg_fetch_assoc($result);
if($line['id'] == $quantity_id) {
    $query = "DELETE FROM quantity WHERE id = $1";
    $result = pg_prepare($dbconn, "delete_col_cards", $query);
    $result = pg_execute($dbconn, "delete_col_cards", [$quantity_id]);
}
header('location: index.php');

?>