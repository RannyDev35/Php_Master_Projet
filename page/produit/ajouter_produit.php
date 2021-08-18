
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Ajouter un Produit</title>
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
        <link rel="stylesheet" href="../../Font-Awesome-4.7.0/css/font-awesome.min.css">

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
$nomProduitErr = "";
$nomProduit = "";
$recu = false;

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["nom"])) {
        $nomProduitErr = "Le champ de nom de produit est obligatoire";
    } else {

        // Prepare la section de user
        $myNom = $_POST["nom"];

        $sql = "SELECT * FROM `produit` WHERE nom_produit = '$myNom' ;";
        $result = mysqli_query($link, $sql);
        if ($count = mysqli_num_rows($result) == 1) {

            $nomProduitErr = "Le nom de produit est deja enregistre essayer un autre";

        } else {
            $nomProduit = test_input($_POST["nom"]);
        }
    }
}

if (empty($nomProduitErr) && !empty($nomProduit)) {

    $sql = "INSERT INTO produit (nom_produit) VALUES ('$nomProduit')";

    if (mysqli_query($link, $sql)) {
        $alert = '<div class="alert alert-primary mt-5 text-center"><h2>Votre enregistrement de produit est reussit</div>';
        $recu = true;

    } else {
        echo "ERROR: Impossible d'exécuter la requête $sql. " . mysqli_error($link);
    }

    mysqli_close($link);

}

?>
        <div class="container">
            <?php echo $alert; ?>
            <br>
            <h2 class="text-center text-primary "><strong>Enregistrement de Produit</strong></h2>
            <form class="form-horizontal ml-5 mt-5" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="nom">
                        Nom de produit:
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control w-50 produit" placeholder="Entrer votre nom" name="nom" value="<?php echo $nomProduit; ?>">
                    </div>
                    <span class="error"> <?php echo $nomProduitErr; ?></span>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="../index.php" class="btn btn-primary mr-3"><i class="fa fa-step-backward"></i> Retour</a>
                        <button type="submit" class="btn btn-default bg-primary text-white"><i class="fa fa-save mr-1"></i>Enregistre </button>
                    </div>                   

                </div>
            </form>
        </div>
        <script src="js/bootstrap.js"></script>

        <?php 
        if ($recu){
            header("refresh: 5; Url = ../index.php");
        }

        ?>

    </body>
</html>

</body>
</html>