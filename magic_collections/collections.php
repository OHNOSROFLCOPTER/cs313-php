<?php
    session_start();
    if(!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
        session_destroy();
        header('Location: index.php');
        die();
    }
    $dbconn = pg_connect("host=localhost dbname=magic_db user=wwillden password=''");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="mc_css.css">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato">
    <title>M-Collections</title>
</head>
<body>
<?php
    if (!isset($_GET['collection'])) {
        include_once 'collection_list.php';
    }
    else {
        include_once 'card_list.php';
    }
?>
</body>
</html>