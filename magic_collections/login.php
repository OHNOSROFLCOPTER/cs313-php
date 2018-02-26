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
<body id='index_body'>
    <h1>Welcome to M-Collections!</h1>
    <div class='white_box' id='loud_box'>
        <form action="do_login.php" method='POST'>
            <?php 
                if (isset($_SESSION['error'])) {
                    if($_SESSION['error'] == 'login') {
                        echo "Wrong username or password";
                    }
                    else if($_SESSION['error'] == 'creation') {
                        echo "That username has been taken";
                    }
                    else {
                        echo "Unexpected Error. Try Again.";
                    }
                    unset($_SESSION['error']);
                }
             ?>
            <div class='input_name'>Username:</div><input type="text" name="username"><br><br>
            <div class='input_name'>Password:</div><input type="password" name="password"><br><br>
            <input type="submit" value='Log in'>
        </form>
    </div>
    <div class='white_box'>
        Sign Up!
        <?php
            if (isset($_SESSION['created_user'])) {
                echo "<br>User successfully created!";
                unset($_SESSION['created_user']);
            }
        ?>
        <form action="create_account.php" method='POST'>
            <div class='input_name'>Username:</div><input type="text" name="username"><br><br>
            <div class='input_name'>Password:</div><input type="password" name="password"><br><br>
            <input type="submit" value='Create Account!'>
        </form>
</body>
</html>