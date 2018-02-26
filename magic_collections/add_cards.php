<?php
session_start();
$user_id = $_SESSION['id'];
$collection_id = $_GET['collection_id'];
$card_name = $_GET['card_name'];
include_once 'database_connect.php';
$dbconn = get_database_connection();
$query = "SELECT id FROM collections WHERE collections.id = $1 AND collections.user_id = $2";
$result = pg_prepare($dbconn, "check_id", $query);
$result = pg_execute($dbconn, "check_id", [$collection_id, $user_id]);
$line = pg_fetch_assoc($result);
if($line['id'] == $collection_id) {
    $query = <<<EOT
        INSERT INTO quantity (collection_id, card_id, quantity)
        VALUES ($1, (SELECT card_id FROM magic_cards WHERE card_name = $2), $3)
EOT;
    $result = pg_prepare($dbconn, 'insert_cards', $query);
    $result = pg_execute($dbconn, 'insert_cards', [$collection_id, $card_name, $_GET['quantity']]);
    if($result) {
        $_SESSION['insert_success'] = True;
    }
    else {
        $_SESSION['insert_success'] = False;
    }
}
header("location: collections.php?collection=$collection_id");
