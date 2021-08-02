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
        $link = mysqli_connect("localhost", "root", "", "compta_db");
        if($link === false){
            die("ERROR: impossile de se connecter. " . mysqli_connect_error());
        }
        
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
                // Prepare la section de user
                $tes_email=$_POST["email"];
                
                $sql_email = "SELECT * FROM user where email= ?";
                $result = mysqli_query($link, $sql_email);
                
                if ($result){

                    if (mysqli_num_rows($result) > 0) {
                   
                        while($row = mysqli_fetch_assoc($result)) {
                        echo "id: " . $row["id_user"]. " - Name: " . $row["nom"]. " " . $row["email"]. "<br>";
                        }
                    } else {
                        echo "0 results";
                    }

                } else{
                    echo'vide';
                }

                // if (mysqli_num_rows($result) > 0) {
                //     // output data of each row
                //     while($row = mysqli_fetch_assoc($result)) {
                //       echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                //     }
                //   } else {
                //     echo "0 results";
                //   }
                  
                //   mysqli_close($link);
                
                // if($stmt = mysqli_prepare($link, $sql)){

                //     // Lier des variables à l'instruction préparée en tant que paramètres
                //     mysqli_stmt_bind_param($stmt, "s", $param_username);
                    
                //     // Définir les paramètres
                //     $param_username = trim($_POST["email"]);
                    
                //     // Tenter d'exécuter l'instruction préparée
                //     if(mysqli_stmt_execute($stmt)){
                //         /* store result */
                //         mysqli_stmt_store_result($stmt);
                        
                //         if(mysqli_stmt_num_rows($stmt) == 1){
                //             $emailErr = "Email est déjà pris.";
                //         } else{
                //             $email = test_input($_POST["email"]);
                //         }
                //     } else{
                //         echo "Oops! Something went wrong. Please try again later.";
                //     }

                //     // Close statement
                //     mysqli_stmt_close($stmt);
                // }
                // $email = test_input($_POST["email"]);
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
        echo $email.'<br>';
        echo $nom.'<br>';

        // if (!empty($nom) && !empty($telephone && !empty($mot_de_pass) && !empty($email))){

           
        //     // $test_email = "SELECT "
        //     $sql = "INSERT INTO user (name, email, phone, password) VALUES ('$nom', '$email', '$telephone', '$mot_de_pass')";
            
        //     if(mysqli_query($link, $sql)){
        //         echo "Insertion réussie.";
        //     } else{
        //     echo "ERROR: Impossible d'exécuter la requête $sql. " . mysqli_error($link);
        //     }

        //     mysqli_close($link);
        //     header("Location: ../../login.php");

        // }
       
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
            <p class='ml-5'>Si vous etes deja un compte connect-vous <a href="login.php">Login</a>.</p>
		</form>
	</div>
	<script src="js/bootstrap.js"></script>

</body>
</html>
