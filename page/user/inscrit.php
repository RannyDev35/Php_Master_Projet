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
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
<!--===============================================================================================-->
</head>

<body>
    <?php
        // definir les variable du valeur
        $nomErr = $emailErr = $telphoneErr = $mot_de_passErr = "";
        $nom = $email = $telephone = $telephone = $mot_de_pass = "";

        function test_input($data) {
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
                    $email = test_input($_POST["email"]);
            }

            if (empty($_POST["telephone"])) {
                $telephoneErr = "Le champ de telephone est obligatoire";
            } else {
                    $telephone = test_input($_POST["telephone"]);
            }

            if (empty($_POST["mot_de_pass"])) {
                $mot_de_passErr = "Le champ mot de pas est obligatoire";
            } else {
                    $mot_de_pass = test_input($_POST["mot_de_pass"]);
            }      
    
        }
       
    ?>
	<div class="container">
        <br>
		<h2 class="text-center text-primary "><strong>INSCRIPTION UTILISATEUR</strong></h2>
		<form class="form-horizontal ml-5 mt-5" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="form-group">
                <label class="control-label col-sm-2" for="nom">
                    Nom: 
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Entrer votre nom" name="nom" value="<?php echo $nom;?>">
                </div>
                <span class="error"> <?php echo $nomErr;?></span>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="email">
                    Email: 
                </label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" placeholder="Entrer votre email" name="email" value="<?php echo $email;?>">
                </div>
                <span class="error"> <?php echo $emailErr;?></span>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="telephone">
                    Telephone: 
                </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Entrer votre telephone" name="telephone" value="<?php echo $telephone;?>">
                </div>
                <span class="error"> <?php echo $telephoneErr;?></span>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">
                    Mot de pass:
                </label>
                <div class="col-sm-10">          
                    <input type="text" class="form-control" placeholder="Entre votre mot de pass" name="mot_de_pass" value="<?php echo $mot_de_pass;?>">
                </div>
                <span class="error"> <?php echo $mot_de_passErr;?></span>
            </div>

            <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default bg-primary text-white">Ajouter</button>
                </div>
			</div>
		</form>
	</div>
    
     <?php 
        if (!empty($nom) && !empty($telephone && !empty($mot_de_pass) && !empty($email))){

            // $link = mysqli_connect("localhost", "root", "", "compta_db");
            // if($link === false){
            //     die("ERROR: impossile de se connecter. " . mysqli_connect_error());
            // }
            // // $test_email = "SELECT "
            // $sql = "INSERT INTO user (name, email, phone, password) VALUES ('$nom', '$email', '$telephone', '$mot_de_pass')";
            
            // if(mysqli_query($link, $sql)){
            //     echo "Insertion réussie.";
            // } else{
            // echo "ERROR: Impossible d'exécuter la requête $sql. " . mysqli_error($link);
            // }

            // mysqli_close($link);
            header("Location: ../../login.php");

        }
       ?>
	
	<script src="js/bootstrap.js"></script>

</body>
</html>
