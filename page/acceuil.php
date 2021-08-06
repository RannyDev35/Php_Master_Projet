<?php
session_start();
$user = $_SESSION['login'];
$role = $_SESSION['role'];

if (!isset($role)) {
    header('Location: ../login.php'); // Redirecting To Home Page
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Your Home Page</title>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="profile">
            <b id="welcome">Welcome : <i><?php echo $role; ?></i></b>
            <b id="logout"><a href="logout.php">Log Out</a></b>
        </div>
    </body>
</html>
