<?php
include "../db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $id= intval($_POST["id"]);
    // echo $id;

    $sql = "DELETE FROM user where id_user=$id";
    if(mysqli_query($link, $sql)){
        $alert = '<div class="alert alert-success mt-5 text-center"><h2>Votre suppresion est reussit</div>';
            header("refresh:2; url = detail_user.php");
    } else{
        echo "ERROR: Impossible d'exécuter la requête $sql. " . mysqli_error($link);
    }

    mysqli_close($link);
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Suppression utilisateur</title>
     <!--===============================================================================================-->
     <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../../css/style.css">
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    <!--===============================================================================================-->
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="mt-3 mb-5 ml-5">SUPPRESION DE L'UTILISATEUR</h3>
                    <?php echo $alert; ?>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger text-center">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Are you sure you want to delete this employee record?</p>
                            <p>
                                <input type="submit" value="OUI" class="btn btn-danger">
                                <a href="detail_user.php" class="btn btn-primary">NON</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>