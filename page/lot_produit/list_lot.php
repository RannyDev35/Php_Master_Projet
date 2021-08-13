
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
		<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../../css/style.css">
		<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
        <link rel="stylesheet" href="../../Font-Awesome-4.7.0/css/font-awesome.min.css">

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
                        <a href="../login.php" class="nav-link text-white ">Login</a>
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
                <div class="col-md-12 bg-warning">
                    <div class="container">
                        <div class="row p-2">
                        <?php
                        include "../db_connect.php";
                        $id = intval($_GET['id']);
                        
                        if (!empty($id)){
                            $sql = "SELECT * FROM `lot_produit` WHERE id_fk_produit = $id;";
                        } else {
                            $sql = "SELECT * FROM `lot_produit`;";
                        }
                        $result = mysqli_query($link, $sql);
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo'<div class="bg-success m-2 p-2">';
                                    echo'<a href="" class="text-dark">';
                        
                                    echo $row['nom_lot'];
                                    echo'</a>';
                                    echo'</div>';
                                }

                            }
                        }

                        
                        ?> 
                        </div>                       
                    </div>
                </div>
                <div class="col-md-12 bg-primary">
                    <h1 class="mt-5 mb-3">Affiche l'utilisateur</h1>
                    <div class="form-group">
                        <label><u>Nom:</u></label>
                        <p class='ml-3'><b><?php //echo $row["name"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label><u>Email</u>:</label>
                        <p class='ml-3'><b><?php //echo $row["email"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label><u>Telephone</u>:</label>
                        <p class='ml-3'><b><?php //echo $row["phone"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label><u>Mot de pass</u>:</label>
                        <p class='ml-3'><b><?php //echo $row["password"]; ?></b></p>
                    </div>
                    <p><a href="detail_user.php" class="btn btn-primary">Retour</a></p>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
