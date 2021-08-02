<?php

    $link = mysqli_connect("localhost", "root", "", "compta_db");
    if($link === false){
        die("ERROR: impossile de se connecter. " . mysqli_connect_error());
    }

?>