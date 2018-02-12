<?php
session_start();
if(isset($_SESSION['username'])) {
    include_once 'collections.php';
}
else {
    include_once 'login.php';
}
?>