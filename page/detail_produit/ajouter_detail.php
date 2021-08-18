<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Ajout un detail produit</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .error {
                color: #FF0000;
                margin-left: 50px;
                margiin-top: 20px;
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

// definir les variable du valeur
$descriptionErr = $prixErr = "";
$dateProd = $idLot = "";
$confirm = 1;
$credit = $debit = 0;

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["description"])) {
        $descriptionErr = "Le champ de description est obligatoire";
    } else {

        $description = test_input($_POST["description"]);
    }
    $debit = $_POST['debit'];
    $credit = $_POST['credit'];

    if ($credit == 0 && $debit == 0){
        $prixErr = "Au moin l'un de prix credit ou debit est obligatoire";
    }
   
    if (!empty($_POST['date'])){
        $dateProd = $_POST['date'];
    }
    $idLot = $_POST['idLot'];
    // echo $confirm

}


if ((!empty($description) && empty($descriptionErr)) ) {

    $sql = "INSERT INTO detail_produit (description, debit, credit ,date_production, confirmation, id_fk_lot_produit)
            VALUES ('$description', '$debit', '$credit','$dateProd', '$confirm', '$idLot')";

    if (mysqli_query($link, $sql)) {
        $alert = '<div class="alert alert-primary mt-5 text-center"><h2>Votre inscription est reussit</div>';
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
            <h2 class="text-center text-primary "><strong>Ajouter le detail de produit</strong></h2>
            <form class="form-horizontal ml-5 mt-5" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label class="control-label col-sm-2">
                        Date production:
                    </label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="date" value="<?php echo $dateProd; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">
                        Description:
                    </label>
                    <div class="col-sm-10">
                        <textarea class="form-control " rows=4 placeholder="Entrer la description de produit" name="description" value="<?php echo $description; ?>"></textarea>
                    </div>
                    <span class="error"> <?php echo $descriptionErr; ?></span>
                    
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">
                        Debit:
                    </label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="debit" value="<?php echo $debit; ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2">
                        Credit:
                    </label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="credit" value="<?php echo $credit; ?>">
                    </div>
                </div>
                <input type="hidden" name="idLot" value="<?php echo $_GET['id']; ?>"/>


                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-5">
                        <button type="submit" class="btn btn-default bg-primary w-100 text-white">Ajouter</button>
                    </div>
                </div>
            </form>
        <</div>
        <script src="js/bootstrap.js"></script>
        <?php 
            if (empty($descriptionErr)){
                header("refresh: 5; url: ajouter_detail.php?id=$idLot");

            }
        ?>
    </body>
</html>
