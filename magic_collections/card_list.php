<?php
session_start();
if (isset($_SESSION['insert_success'])) {
    if($_SESSION['insert_success']) echo "Cards Added";
    else echo "Add failed. Is the card's name correct?";
    unset($_SESSION['insert_success']);
}
?>
<table style="width: 30%">
<?php
if ( basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) ) {
    http_response_code(404);
    die();
}
    $collection_id = $_GET['collection'];
    $result = pg_prepare($dbconn, "get_card_list", 
    "SELECT collections.collection_name, magic_cards.card_name, quantity.quantity, quantity.id
    FROM collections INNER JOIN quantity ON (collections.id = quantity.collection_id)
    INNER JOIN magic_cards ON (quantity.card_id = magic_cards.card_id)
    WHERE collections.id = $1;");
    $result = pg_execute($dbconn, "get_card_list", [$_GET['collection']]);
    while ($line = pg_fetch_assoc($result)) {
        $card_name = $line['card_name'];
        $quantity = $line['quantity'];
        $quantity_id = $line['id'];
        echo "<tr><td>$card_name</td>
    <td>$quantity</td>
    <td><form action='delete_card_row.php'>
    <input type='hidden' name='quantity_id' value=$quantity_id>
    <input type='hidden' name='collection_id' value=$collection_id>
    <input type='submit' value='Delete Cards'></form></td></tr>";
    }
?>
<tr>
    <form action='add_cards.php'>
        <td><input id='ajax'    type='text' list='json-datalist' placeholder='e.g. Lord of the Pit' name='card_name'></td>
        <datalist id='json-datalist'></datalist>
        <td><input type='number' name='quantity' value=0></td>
        <input type='hidden' name='collection_id' value=<?php echo $_GET['collection'];?>>
        <td><input type='submit' value='Add Card'></td>
    </form>
</tr>
</table>
<a href='collections.php'>Go Back to Collections</a>
<script>
//script is for autocompletion for adding cards field
var dataList = document.getElementById('json-datalist');
var input = document.getElementById('ajax');
var request = new XMLHttpRequest();

request.onreadystatechange = function(response) {
  if (request.readyState === 4) {
    if (request.status === 200) {
      var jsonOptions = JSON.parse(request.responseText);

      jsonOptions.forEach(function(item) {
        var option = document.createElement('option');
        option.value = item;
        dataList.appendChild(option);
      });

      input.placeholder = "e.g. Lord of the Pit";
    } else {
      input.placeholder = "Couldn't load datalist options :(";
    }
  }
};

input.placeholder = "Loading options...";
request.open('GET', 'get_card_names.php', true);
request.send();
</script>