<?php
session_start();

$user = $_SESSION['login'];

// $row = mysqli_fetch_array($result);

$row = mysql_fetch_assoc($sql);
$login_session = $row['email'];

if (!isset($login_session)) {
    mysql_close($connection); // Closing Connection
    header('Location: login.php'); // Redirecting To Home Page
}
