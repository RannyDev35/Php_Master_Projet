<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Produit</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Font-Awesome-4.7.0/css/font-awesome.min.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 75%;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark fixed-top">
        <div class="container">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="../index.php" class="mr-2 text-white fa fa-home fa-2x"></a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="../login.php" class="nav-link text-white ">Login</a>
                    </li> -->
                    <li class="nav-item">
                        <a href="../logout.php" class="nav-link text-white ">Deconecter</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper mt-5">
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Produit</h2>
                        <a href="../index.php" class="btn btn-primary pull-right"><i class="fa fa-step-backward"></i> Retour</a>
                        <a href="ajouter_produit.php" class="btn btn-primary ml-5 pull-left"><i class="fa fa-plus"></i> Ajouter produit</a>
                    </div>
<?php
    session_start();
    if (!isset($_SESSION['role'])) {
        header("Location: ../index.php");
    }
    include "../db_connect.php";

    $sql = "SELECT * FROM `produit` ;";
    $result = mysqli_query($link, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo '<table class="table table-bordered table-striped">';
            echo "<thead>";
            echo "<tr>";
            echo "<th>#</th>";
            echo "<th>Nom de produit</th>";
            echo "<th>Action</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['id_produit'] . "</td>";
                echo "<td>" . $row['nom_produit'] . "</td>";
                echo "<td>";
                echo '<a href="modifier_produit.php?id=' . $row['id_produit'] . '" class="mr-3" title="Modifier" data-toggle="tooltip"><span class="fa fa-edit"></span></a>';
                echo '<a href="supprimer_produit.php?id=' . $row['id_produit'] . '" title="Supprimer" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<div class='alert alert-danger'><em>Aucun enregistrement n'a été trouvé.</em></div>";
        }
    } else {
        echo "Oups! Quelque chose s'est mal passé. Veuillez réessayer plus tard.";
    }

    // Close connection
    $mysqli->close();
?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>