<?php
include "../db_connect.php";
$recu = false;

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $id= intval($_POST["id"]);
    $idLot = intval($_POST["idLot"]);

    $sql = "DELETE FROM detail_produit where id_produit=$id";
    if(mysqli_query($link, $sql)){
        $alert = '<div class="alert alert-success mt-5 text-center"><h2>Votre suppresion est reussit</div>';
        $recu = true;
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
    <title>Suppression uu Detail de produit</title>
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
                    <h3 class="mt-3 mb-5 ml-5">SUPPRESION UN DETAIL DE PRODUIT</h3>
                    <?php echo $alert; ?>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger text-center">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <input type="hidden" name="idLot" value="<?php echo trim($_GET["idLot"]); ?>"/>
                            <p>Êtes-vous sûr de vouloir supprimer cette fiche de datail produit?</p>
                            <p>
                                <input type="submit" value="OUI" class="btn btn-danger">
                                <a href="liste_detail.php?id=<?php echo $_GET["idLot"]; ?>" class="btn btn-primary">NON</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
<?php
        
    if($recu=='ok'){
        echo "<script type='text/javascript'>";
        echo "setTimeout(function() {window.location.href = 'liste_detail.php?id=$idLot';},3000);";
        echo"</script>";
    }

?>
</body>
</html>