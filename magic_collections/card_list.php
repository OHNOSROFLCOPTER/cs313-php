<ul>
<?php
if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) {
    http_response_code(404);
    die();
}
        $result = pg_prepare($dbconn, "get_card_list", 
        "SELECT collections.collection_name, magic_cards.card_name, quantity.quantity
        FROM collections INNER JOIN quantity ON (collections.id = quantity.collection_id)
        INNER JOIN magic_cards ON (quantity.card_id = magic_cards.card_id)
        WHERE collections.id = $1;");
        $result = pg_execute($dbconn, "get_card_list", [$_GET['collection']]);
        while ($line = pg_fetch_assoc($result)) {
            $card_name = $line['card_name'];
            $quantity = $line['quantity'];
            echo "<li>$card_name --- $quantity</li>";
        }
?>
</ul>