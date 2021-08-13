<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Metre a jour l'utilisateur</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .error {
                color: #FF0000;
                margin-left: 50px;
                margin-top: 20px;
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
$nomErr = $emailErr = $telphoneErr = $mot_de_passErr = "";
$nom = $email = $telephone = $telephone = $mot_de_pass = $iduser = "";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$id = $_GET['id'];
// echo $id;

$sql = "SELECT * FROM `user` WHERE id_user= '$id' ;";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $nom = $row['name'];
    $email = $row['email'];
    $telephone = $row['phone'];
    $mot_de_pass = $row['password'];
    $iduser = $row['id_user'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["nom"])) {
        $nomErr = "Le champ de nom est obligatoire";
    } elseif($_POST['nom'] != $nom) {
        $nom = test_input($_POST["nom"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Le champ d'email est obligatoire";
    } elseif($_POST['email'] != $email ) {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["telephone"])) {
        $telephoneErr = "Le champ de telephone est obligatoire";
    } elseif ($_POST['telephone'] != $telephone ) {
        $telephone = test_input($_POST["telephone"]);
    }

    if (empty($_POST["mot_de_pass"])) {
        $mot_de_passErr = "Le champ mot de pas est obligatoire";
    } elseif($_POST['mot_de_pass'] != $mot_de_pass) {
        $mot_de_pass = test_input($_POST["mot_de_pass"]);
    }

    if (empty($nomErr) && empty($telephoneErr) && empty($mot_de_passErr)) {

        // echo 'lala'.$_POST['id'];
        $id = intval($_POST['id']);
        $telephone = intval($telephone);
        // echo $id;
        $sql = "UPDATE user  SET name='$nom', email= '$email', phone=$telephone, password='$mot_de_pass' WHERE id_user = $id;";
    
        if (mysqli_query($link, $sql)) {
            $alert = '<div class="alert alert-success mt-5 text-center"><h2>Votre modification est reussit,</div>';
            header("refresh:2; url = modifier_user.php?id=$id");
    
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
            <h2 class="text-center text-primary "><strong>METTRE A JOUR L'UTILISATEUR</strong></h2>
            <form class="form-horizontal ml-5 mt-5" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="nom">
                        Nom:
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Entrer votre nom" name="nom" value="<?php echo $nom; ?>">
                    </div>
                    <span class="error"> <?php echo $nomErr; ?></span>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">
                        Email:
                    </label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" placeholder="Entrer votre email" name="email" value="<?php echo $email; ?>">
                    </div>
                    <span class="error"> <?php echo $emailErr; ?></span>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="telephone">
                        Telephone:
                    </label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" placeholder="Entrer votre telephone" name="telephone" value="<?php echo $telephone; ?>">
                    </div>
                    <span class="error"> <?php echo $telephoneErr; ?></span>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">
                        Mot de pass:
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Entre votre mot de pass" name="mot_de_pass" value="<?php echo $mot_de_pass; ?>">
                    </div>
                    <span class="error"> <?php echo $mot_de_passErr; ?></span>
                </div>
                <input type="hidden" name="id" value="<?php echo $iduser; ?>"/>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default bg-primary w-50 text-white">Modifier</button>
                        <a href="detail_user.php" class="btn btn-primary ml-2">Retour</a>
                    </div>
                </div>
                
            </form>
        </div>
        <script src="js/bootstrap.js"></script>

    </body>
</html>
