<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<!--===============================================================================================-->
</head>
<?php
	// session_start();
	// $nomserver = "localhost";
    // $utlisateur = "root";
    // $motpass = "";
    // $nombd = "compta_db";
	
    // // Cree un connection
    // $link = mysqli_connect($nomserver, $utlisateur, $motpass, $nombd);

    // // entre sur le connection
    // if($link === false){
    //     die("ERROR: impossile de se connecter. " . mysqli_connect_error());
    // }
	// $sql = "SELECT * FROM `user`;";
	// $result = mysqli_query($link, $sql);
	// $row = mysqli_fetch_array($result);
	// echo $row[2];

	// if($result = mysqli_query($link, $sql)){
	// 	if(mysqli_num_rows($result) > 0){
	// 		echo "<table border=1>";
	// 			echo "<tr>";
	// 				echo "<th>id</th>";
	// 				echo "<th>Nom</th>";
	// 			echo "</tr>";
	// 		while($row = mysqli_fetch_array($result)){
	// 			echo "<tr>";
	// 				echo "<td>" . $row['id'] . "</td>";
	// 				echo "<td>" . $row['nom'] . "</td>";
		
	// 			echo "</tr>";
	// 		}
	// 		echo "</table>";
		  
	// 		mysqli_free_result($result);
	// 	} else{
	// 		echo "Table vide";
	// 	}
	// } else{
	// 	echo "ERROR: impossible d'exécuter la requête $sql. " . mysqli_error($link);
	// }
	
	// echo 'sql'.$result;
?>
<body>
	<div class="container">
		<h2>Connecter vous</h2>
		<form class="form-horizontal" action="">
			<div class="form-group">
			<label class="control-label col-sm-2" for="email">Email:</label>
			<div class="col-sm-10">
				<input type="email" class="form-control" placeholder="Entrer votre email" name="email">
			</div>
			</div>
			<div class="form-group">
			<label class="control-label col-sm-2" for="pwd">Password:</label>
			<div class="col-sm-10">          
				<input type="password" class="form-control" placeholder="Entre votre mot de pass" name="mot_de_pass">
			</div>
			</div>

			<div class="form-group">        
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default">Connecter</button>
			</div>
			</div>
		</form>
	</div>
	
	<script src="js/bootstrap.js"></script>

</body>
</html>
