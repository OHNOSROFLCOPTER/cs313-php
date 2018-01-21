<?php
/**
 * header.php
 * 
 * @author William Willden <wwillden@outlook.com>
 * @link   wwillden.wordpress.com
 * This loads the header that goes in the beginning of every
 * php page. This includes the nav bar that will be at the
 * top.
 */
require_once 'vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="my_css.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>William Willden's Web Page</title>
</head>
<body>
<div class="container-fluid">
    <div class="row" id="banner">
        <div class="col-sm-1 img-container">
            <img src="me.jpg">
        </div>
    <div class="col-sm-11">
        <div class="jumbotron">
            <h1>William Willden</h1>
            <p>Software Engineer in the Making</p>
        </div>
    </div>
</div>
<nav class="navbar navbar-default">
    <div class="container-fluid"> 
        <div class="navbar-header"> 
            <a class="navbar-brand" href="index.php">William Willden's Site</a> 
        </div> 
        <ul class="nav navbar-nav"> 
            <li><a href="index.php">About Me</a></li> 
            <li><a href="assignments.php">Assignments</a></li>
            <li><a href="http://github.com/ohnosroflcopter">My Github</a></li>
        </ul>
    </div>
</nav>

        