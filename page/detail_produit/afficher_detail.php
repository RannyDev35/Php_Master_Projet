<?php

// Vérifier l'existence du paramètre id avant de poursuivre le traitement
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Inclure le fichier db_connect
    include "../db_connect.php";
    $id = $_GET["id"];

    // Préparer une déclaration de sélection
    $sql = "SELECT * FROM `detail_produit` WHERE id_produit = '$id' ;";
    $result = mysqli_query($link, $sql);
    if ($result) {

        if ($count = mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
        } else {
            // URL doesn't contain valid id parameter. Redirect to error page
            // header("location: error.php");
            exit();
        }

    } else {
        echo "Oops! guuuSomething went wrong. Please try again later.";
    }

    // Fermer la connection
    mysqli_close($link);
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <style>
        .wrapper{
            width: 50%;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">Affiche le detail de produit</h1>
                    <div class="form-group">
                        <label><u>Id de Produit:</u></label>
                        <p class='ml-3'><b><?php echo $row["id_produit"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label><u>Description de produit:</u></label>
                        <p class='ml-3'><b><?php echo $row["description"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label><u>Debit</u>:</label>
                        <p class='ml-3'><b><?php echo $row["debit"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label><u>Credit</u>:</label>
                        <p class='ml-3'><b><?php echo $row["credit"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label><u>Date de production</u>:</label>
                        <p class='ml-3'><b><?php echo $row["date_production"]; ?></b></p>
                    </div>
                    <p><a href="liste_detail.php?id=<?php echo $_GET['idLot'];?>" class="btn btn-primary">Retour</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>