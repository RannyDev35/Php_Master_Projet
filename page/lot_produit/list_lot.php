
<?php
    session_start();
    
    if (isset($_SESSION['role'])) {
        $login = $_SESSION['role'];
    }else{
        header("Location: ../login.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lot de produit</title>

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
                        <a href="../index.php" class="mr-2 text-white fa fa-home fa-2x"></a>
                    </li>
<?php 
    $id = $_GET['id'];

    if ($login == 'admin'){
        echo '<li class="nav-item">';
        echo '<a href="ajouter_lot.php?id='.$id.'" class="nav-link text-white ml-2">Ajouter Lot Produit</a>';
        echo '</li>';
        echo '<li class="nav-item">';
        echo '<a href="lot_produit.php?id='.$id.'" class="nav-link ml-3 text-white ">Lot</a>';
        echo '</li>';
    } 

    if($login){
        echo '<li class="nav-item">';
        echo '<a href="../logout.php" class="nav-link text-white ml-3 ">Deconnect</a>';
        echo '</li>';
    }
?>
                
                </ul>
            </div>
        </div>
    </nav>
    <div class="mt-5">
        <div class="container-fluid ">
            <div class="row p-5 ">

                <div class="col-md-12">
                    <h3 class="mt-5 ml-2 mb-2">Liste des Lots de produit:</h3>
                    <div class="container">
                        <div class="row p-2">
<?php
    include "../db_connect.php";
    // $sql = "SELECT * FROM detail_produit 
    //         INNER JOIN lot_produit ON 
    //         detail_produit.id_fk_lot_produit = lot_produit.id_lot_produit
    //         WHERE id_fk_produit = ".$id." ; ";
    $sql = "SELECT * FROM lot_produit WHERE id_fk_produit = $id ; ";
    $result = mysqli_query($link, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo'<div class="bg-success m-2 p-2 rounded">';
                echo'<a href="../detail_produit/liste_detail.php?id='.$row['id_lot_produit'].'" class="text-white">';
                echo $row['nom_lot'];
                echo'</a>';
                echo'</div>';
            }

        }else {
            echo'<div class=" m-2 p-2">';
            echo'<p class="text-white text-center bg-danger p-3 rounded">';
            echo 'Le donne est vide ou il y a de eurreur';
            echo'</p>';
            echo'</div>';
        }
    }
    
?> 
                        </div>                       
                    </div>
                    <p class="text-center mt-3 ">
                        <strong>
<?php 
    if ($login){
        echo 'Il faut clique le nom de lot produit pour voir les detail';
    }else{
        echo 'Connectez pour voir le contenue de plateform';
    }
?>
                        </stong>
                    </p>
                </div>
                
            </div>
        </div>
    </div>

    <div class="wrapper mt-5">
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Liste Lot de Produit</h2>
                        <a href="list_lot.php?id=<?php echo $_GET['id'] ?>" class="btn btn-primary pull-right"><i class="fa fa-step-backward"></i> Retour</a>
                        <a href="ajouter_lot.php?id=<?php echo $_GET['id'] ?>" class="btn btn-primary ml-5 pull-left"><i class="fa fa-plus"></i> Ajouter produit</a>
                    </div>
<?php

    $id = $_GET['id'];

    $sql = "SELECT * FROM `detail_produit`";
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
                echo "<td>" . $row['id_lot_produit'] . "</td>";
                echo "<td>" . $row['nom_lot'] . "</td>";
                echo "<td>";
                echo '<a href="modifier_lot.php?id=' . $row['id_lot_produit'] . '" class="mr-3" title="Modifier" data-toggle="tooltip"><span class="fa fa-edit"></span></a>';
                echo '<a href="supprimer_lot.php?id=' . $row['id_lot_produit'] . ' " title="Supprimer" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
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
