
<?php

// if (isset($_SESSION['role'])) {
//     header("location: acceuil.php");
// }else {
//     header("location: login.php");
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>

    <!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../Font-Awesome-4.7.0/css/font-awesome.min.css">

	<!--===============================================================================================-->

</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark fixed-top">
        <div class="container">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="index.php" class="mr-2 text-white fa fa-home fa-2x"></a>
                    </li>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link text-white ">Login</a>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link text-white">Inscription</div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link text-white"> Deconecter</div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row bg-success p-5 ">
                <div class="col-md-12 bg-primary">
                    <h1 class="mt-2 mb-2 text-center">Bievenue sur le gestion de Produit</h1>
                </div>
                <div class="col-md-12 bg-warning">
                    <h3 class="mt-5 ml-2 mb-2">Liste des produit:</h3>
                    <div class="container">
                        <div class="row p-2">
                        <?php
                        include "db_connect.php";
                        $sql = "SELECT * FROM `produit` ;";
                        $result = mysqli_query($link, $sql);
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo'<div class="bg-success m-2 p-2">';
                                    echo'<a href="lot_produit/list_lot.php?id='.$row['id_produit'].'" class="text-dark">';
                                    echo $row['nom_produit'];
                                    echo'</a>';
                                    echo'</div>';
                                }

                            }
                        }
                        ?> 
                        </div>                       
                    </div>
                    <p class="text-center">Il faut clique le nom de produit pour voir les lot de produit</p>
                </div>
                
            </div>
        </div>
    </div>
    
</body>
</html>
