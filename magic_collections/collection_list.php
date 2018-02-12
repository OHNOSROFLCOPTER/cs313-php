<ul>
<?php
    if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) {
        http_response_code(404);
        die();
    }
    $result = pg_prepare($dbconn, "get_collections", "SELECT * FROM collections WHERE user_id = $1");
    $result = pg_execute($dbconn, "get_collections", [$_SESSION['id']]);
    while ($line = pg_fetch_assoc($result)) {
        $collection_name = $line['collection_name'];
        $collection_id = $line['id'];
        echo "<li><a href=collections.php?collection=$collection_id>$collection_name</a></li>";
    }
?>
</ul>