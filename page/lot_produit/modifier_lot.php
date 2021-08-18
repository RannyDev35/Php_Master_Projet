
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Modifier un Produit</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .error {
                color: #FF0000;
                margin-left: 50px;
                margin-top: 20px;
            }
            .produit {
                margin-top: 10px;
                /* width: 50%; */
                height: 75px;
            }
        </style>

    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../../css/style.css">
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    <!--===============================================================================================-->
    </head>

    <body>

<?php
    session_start();
    
    if (!isset($_SESSION['role'])) {
        header("Location: ../login.php");
    }

    include "../db_connect.php";

    // definir les variable du valeur
    $nomLotErr ="";
    $nomLot = $idProduit = "";
    $recu =false;

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM `lot_produit` WHERE id_lot_produit= '$id' ;";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $nomLot = $row['nom_lot'];
        $idLot = $row['id_lot_produit'];
        $idProduit = $row['id_fk_produit'];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["nom"])) {
            $nomLotErr = "Le champ de nom de produit est obligatoire";
        } else {

            // Prepare la section de user
            $myNom = $_POST["nom"];
            $myProduit = intval($_POST["produit"]);
            $myId =  intval($_POST['id']);

            $sql = "SELECT * FROM `lot_produit` WHERE nom_lot = '$myNom'  AND id_fk_produit = $myProduit;";
            $result = mysqli_query($link, $sql);
            if ($count = mysqli_num_rows($result) == 1) {

                $nomProduitErr = "Le nom de produit est deja enregistre essayer un autre";

            } else {
                $nomLot = test_input($_POST["nom"]);
            }
        }
        if (empty($nomProduitErr)) {
            $sql = "UPDATE lot_produit  SET nom_lot='$nomLot' WHERE id_lot_produit = $myId;";
        
            if (mysqli_query($link, $sql)) {
                $alert = '<div class="alert alert-primary mt-5 text-center"><h2>Votre modification de lot produit est reussit</div>';
                $recu = true;

            } else {
                echo "ERROR: Impossible d'exécuter la requête $sql. " . mysqli_error($link);
            }
        
            mysqli_close($link);
        
        }
        
    }


?>
        <div class="container">
            <?php echo $alert; ?>
            <br>
            <h2 class="text-center text-primary "><strong>Modification de Produit</strong></h2>
            <form class="form-horizontal ml-5 mt-5" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="nom">
                        Nom de produit:
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control w-50 produit" placeholder="Entrer votre nom" name="nom" value="<?php echo $nomLot; ?>">
                    </div>
                    <span class="error"> <?php echo $nomProduitErr; ?></span>
                </div>
                <input type="hidden" name="id" value="<?php echo $idLot; ?>"/>
                <input type="hidden" name="produit" value="<?php echo $idProduit; ?>"/>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default bg-primary text-white">Modifier</button>
                    </div>
                    
                </div>
            </form>
        </div>
        <?php 
        if (!empty($nomProduitErr )){
            header("refresh: 5; Url = modifier_lot.php?id=$myId");
        }
        if ($recu){
            header("refresh: 5; Url = lot_produit.php?id=$myProduit");
        }

        ?>
        <script src="js/bootstrap.js"></script>

    </body>
</html>