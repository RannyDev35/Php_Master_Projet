<?php
session_start();
    
if (!isset($_SESSION['role'])) {
    header("Location: ../login.php");
}

include "../db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $id= intval($_POST["id"]);
    // echo $id;

    $sql = "DELETE FROM produit where id_produit=$id";
    if(mysqli_query($link, $sql)){
        $alert = '<div class="alert alert-success mt-5 text-center"><h2>Votre suppresion est reussit</div>';
            header("refresh:2; url = liste_produit.php");
    } else{
        echo "ERROR: Impossible d'exécuter la requête $sql. " . mysqli_error($link);
    }

    mysqli_close($link);
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Suppression Produit</title>
     <!--===============================================================================================-->
     <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../../css/style.css">
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    <!--===============================================================================================-->
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="mt-3 mb-5 ml-5">SUPPRESION DE PRODUIT</h3>
                    <?php echo $alert; ?>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger text-center">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Vous etes sur de supprimer le produit?</p>
                            <p>
                                <input type="submit" value="OUI" class="btn btn-danger">
                                <a href="liste_produit.php" class="btn btn-primary">NON</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>