<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Inscription utilisateur</title>
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
$nomErr = $emailErr = $telphoneErr = $mot_de_passErr = "";
$nom = $email = $telephone = $telephone = $mot_de_pass = "";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["nom"])) {
        $nomErr = "Le champ de nom est obligatoire";
    } else {

        $nom = test_input($_POST["nom"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Le champ d'email est obligatoire";
    } else {
        // Prepare la section de user
        $myemail = $_POST["email"];

        $sql = "SELECT * FROM `user` WHERE email= '$myemail' ;";
        $result = mysqli_query($link, $sql);
        if ($count = mysqli_num_rows($result) == 1) {

            $emailErr = "L'Email exist deja essayer un autre";

        } else {
            $email = test_input($_POST["email"]);
        }

    }

    if (empty($_POST["telephone"])) {
        $telephoneErr = "Le champ de telephone est obligatoire";
    } else {
        // Prepare la section de user
        $myphone = $_POST["telephone"];

        $sql = "SELECT * FROM `user` WHERE phone= '$myphone' ;";
        $result = mysqli_query($link, $sql);
        if ($count = mysqli_num_rows($result) == 1) {

            $telephoneErr = "Le telephone est exist deja essayer un autre";

        } else {
            $telephone = test_input($_POST["telephone"]);
        }
    }

    if (empty($_POST["mot_de_pass"])) {
        $mot_de_passErr = "Le champ mot de pas est obligatoire";
    } else {
        $mot_de_pass = test_input($_POST["mot_de_pass"]);
    }

}

if (empty($nomErr) && empty($telephoneErr && empty($mot_de_passErr) && !empty($email)) && !empty($nom) && !empty($telephone && !empty($mot_de_pass) && !empty($email))) {

    $sql = "INSERT INTO user (name, email, phone, password) VALUES ('$nom', '$email', '$telephone', '$mot_de_pass')";

    if (mysqli_query($link, $sql)) {
        $alert = '<div class="alert alert-primary mt-5 text-center"><h2>Votre inscription est reussit, </h2><p>Patient le redirect vers le page login</p></div>';
        header("refresh:3; url= detail_user.php");

    } else {
        echo "ERROR: Impossible d'exécuter la requête $sql. " . mysqli_error($link);
    }

    mysqli_close($link);

}

?>
        <div class="container">
            <?php echo $alert; ?>
            <br>
            <h2 class="text-center text-primary "><strong>INSCRIPTION UTILISATEUR</strong></h2>
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

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default bg-primary text-white">Ajouter</button>
                    </div>
                </div>
                <p class='ml-5'>Si vous etes deja un compte connect-vous? <a class="ml-2" href="../login.php">Login</a>.</p>
            </form>
        </div>
        <script src="js/bootstrap.js"></script>

    </body>
</html>
