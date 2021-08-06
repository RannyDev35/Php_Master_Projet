<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<!--===============================================================================================-->
	</head>

	<?php
include "db_connect.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // email et mot de passe envoyés depuis le formulaire
    // mysql_real_escape_string() protège une commande SQL

    $myemail = mysqli_real_escape_string($link, $_POST['email']);
    $mypassword = mysqli_real_escape_string($link, $_POST['password']);

    $sql = "SELECT * FROM `user` WHERE email= '$myemail' and password= '$mypassword' ;";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    if ($result) {
        $count = mysqli_num_rows($result);

        // Si le résultat correspond à $myemail et $mypassword, la ligne du tableau doit être 1 ligne
        if ($count == 1) {
            // $_SESSION['login'] = $myemail;
            $_SESSION['role'] = $row['role'];

            header("location: index.php");
        } else {
            $error = '<p class="text-danger text-center">Votre email ou votre mot de passe est invalide</p>';
        }

    } else {
        echo "noooooo" . $myemail;
    }
}
?>
	<body>

		<div class="container mt-5">
			<div class="row">
				<div class="col-md-4 offset-md-4 mylogin">
					<div class="login-form mt-4 p-4">
						<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row g-3">
							<h2 class="ml-5 text-primary">Connecter vous</h2>
							<div class="col-12 mt-3">
								<label>Email</label>
								<input type="email" name="email" class="form-control" placeholder="Votre email">
							</div>
							<div class="col-12 mt-3">
								<label>Mot de pass</label>
								<input type="password" name="password" class="form-control" placeholder="Mot de pass">
							</div>

							<div class="col-12 mt-5">
								<button type="submit" class="btn btn-primary w-100 float-end">Login</button>
							</div>
						</form>
						<hr class="mt-4">
						<div class="col-12">
						<?php echo $error; ?>
						</div>
						<hr class="mt-4">
						<div class="col-12">
							<p class="text-center mb-0">Si vous n'avez pas encore de compte inscrivez-vous?<a class="ml-2" href="user/inscrit_user.php">Inscription</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="../js/bootstrap.bundle.min.js"></script>

	</body>
</html>
