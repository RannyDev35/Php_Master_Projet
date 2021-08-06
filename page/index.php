
<?php
include 'login.php'; // Includes Login Script

if (isset($_SESSION['role'])) {
    header("location: acceuil.php");
}
?>
