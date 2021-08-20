<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Modifier un detail produit</title>
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
$descriptionErr = $prixErr = "";
$dateProd = date("d/m/y");
$idLot = "";
$confirm = 1;
$credit = $debit = 0;
$recu='';

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$id = $_GET['id'];
$sql = "SELECT * FROM `detail_produit` WHERE id_produit= '$id' ;";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $idDetail = $row['id_produit'];
    $description = $row['description'];
    $debit = $row['debit'];
    $credit = $row['credit'];
    $dateProd = $row['date_production'];
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
    if ($credit != 0 && $debit != 0){
        $prixErr = "Seul de prix debit et credit est remplir ";
    }
   
    if (!empty($_POST['date'])){
        $dateProd = $_POST['date'];
    }
    $idDetail = $_POST['idDetail'];
    $idLot = $_POST['idLot'];
    // ||

    if ((!empty($description) && empty($descriptionErr)) && empty($prixErr) ) {

        $sql = "UPDATE detail_produit SET description = '$description', debit = '$debit',
                credit= '$credit' ,date_production= '$dateProd', confirmation='$confirm'
                WHERE id_produit = '$idDetail';";
    
        if (mysqli_query($link, $sql)) {
            $alert = '<div class="alert alert-primary mt-5 text-center"><h2>Votre inscription est reussit</div>';
            $recu = 'ok';
    
        } else {
            echo "ERROR: Impossible d'exécuter la requête $sql. " . mysqli_error($link);
        }
    
        mysqli_close($link);
    
    }
    // echo $confirm
}

?>
        <div class="container">
            <?php echo $alert; ?>
            <br>
            <h2 class="text-center text-primary "><strong>Modifier le detail de produit</strong></h2>
            <form class="form-horizontal ml-5 mt-5" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label class="control-label col-sm-2">
                        <strong>Date production:</strong>
                    </label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="date" value="<?php echo $dateProd; ?>">
                    </div>
                    <em class="text-dark ml-5 mt-5"> 
                        Si vous ne choisi pas la date, la valeur par defaut seras date aujourd'hui
                     </em>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-10">
                        <strong>Description:</strong>
                        <span class="text-danger ml-5"> *Obligatoire</span>

                    </label>
                    <div class="col-sm-10">
                        <textarea class="form-control " rows=4 placeholder="Entrer la description de produit" name="description" value="<?php echo $description; ?>">
                        <?php echo $description; ?> 
                        </textarea>
                    </div>
                    <span class="error"> <?php echo $descriptionErr; ?></span>
                    
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-10">
                        <strong>Debit:</strong>
                        <span class="text-danger ml-5"> **L'un de Debit et Credit sont obligatoire</span>
                    </label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="debit" value="<?php echo $debit; ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2">
                        <strong>Credit:</strong>
                    </label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="credit" value="<?php echo $credit; ?>">
                    </div>
                </div>
                <input type="hidden" name="idDetail" value="<?php echo $_GET['id']; ?>"/>
                <input type="hidden" name="idLot" value="<?php echo $_GET['idLot']; ?>"/>


                <div class="form-group">
                    <span class="error "> <?php echo $prixErr; ?></span>

                    <div class="col-sm-offset-2 col-sm-5">
                        <a href="liste_detail.php?id=<?php echo $_GET['idLot']; ?>" class="btn btn-primary mr-3">
                            <i class="fa fa-step-backward"></i> Retour
                        </a>

                        <button type="submit" class="btn btn-default bg-primary text-white">
                            <i class="fa fa-exchange"></i> Modifier
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <script src="js/bootstrap.js"></script>
        <?php 
            // $myId = $_GET['id'];
            
           
            if(!empty($descriptionErr) || !empty($prixErr)){ 
                echo "<script type='text/javascript'>";
                echo "setTimeout(function() {window.location.href = 'modifier_detail.php?id=$idDetail&idLot=$idLot';},5000);";
                echo"</script>";
            }
            
            if($recu=='ok'){
                echo "<script type='text/javascript'>";
                echo "setTimeout(function() {window.location.href = 'liste_detail.php?id=$idLot';},5000);";
                echo"</script>";
            }

        ?>
    </body>
</html>
