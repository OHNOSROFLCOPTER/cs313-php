<?php
    include_once 'database_connect.php';
    $dbconn = get_database_connection();
    $query = 'SELECT card_name FROM magic_cards';
    $result = pg_prepare($dbconn, 'get_card_names', $query);
    $result = pg_execute($dbconn, 'get_card_names', []);
    $card_array = array();
    while ($line = pg_fetch_assoc($result)) {
        $card_array[] = $line['card_name'];
    }
    echo json_encode($card_array);
    die();
?>