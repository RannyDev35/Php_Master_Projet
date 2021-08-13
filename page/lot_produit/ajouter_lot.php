
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Ajouter un Lot</title>
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
include "../db_connect.php";
$id = $_GET['id'];

// definir les variable du valeur
$nomLotErr ="";
$nomLot = $idProduit = "";


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["nom"])) {
        $nomLotErr = "Le champ de nom de produit est obligatoire";
    } else {

        // Prepare la section de user
        $myNom = $_POST["nom"];
        $myId = intval($_POST["id"]);

        $sql = "SELECT * FROM `lot_produit` WHERE nom_lot = '$myNom'  AND id_fk_produit = $myId;";
        $result = mysqli_query($link, $sql);
        if ($count = mysqli_num_rows($result) == 1) {

            $nomLotErr = "Le nom de lot produit est deja enregistre essayer un autre";

        } else {
            $nomLot = test_input($_POST["nom"]);
            $idProduit = intval($_POST["id"]);
        }
    }
}

if (empty($nomLotErr) && !empty($nomLot)) {

    // $sql = "INSERT INTO lot_produit (nom_lot, id_fk_produit) VALUES ('$nomLot', '$idProduit')";
    $sql = "INSERT INTO `lot_produit` (`id_lot_produit`, `nom_lot`, `id_fk_produit`) VALUES (NULL, '$nomLot', '$idProduit');";

    if (mysqli_query($link, $sql)) {
        $alert = '<div class="alert alert-primary mt-5 text-center"><h2>Votre enregistrement de produit est reussit</div>';
        header("refresh:3;");

    } else {
        echo "ERROR: Impossible d'exécuter la requête $sql. " . mysqli_error($link);
    }

    mysqli_close($link);

}

?>
        <div class="container">
            <?php echo $alert; ?>
            <br>
            <h2 class="text-center text-primary "><strong>Enregistrement de Lot de  Produit</strong></h2>
            <form class="form-horizontal ml-5 mt-5" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="nom">
                        Nom de lot de produit:
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control w-50 produit" placeholder="Entrer votre nom" name="nom" value="<?php echo $nomLot; ?>">
                    </div>
                    <span class="error"> <?php echo $nomLotErr; ?></span>
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default bg-primary text-white">Enregistre</button>
                    </div>
                </div>
            </form>
        </div>
        <script src="js/bootstrap.js"></script>

    </body>
</html>

</body>
</html>