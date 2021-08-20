
<?php
    session_start();
    
    if (isset($_SESSION['role'])) {
        $login = $_SESSION['role'];
    }else{
        header("Location: ../login.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lot de produit</title>

    <!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../../css/style.css">
		<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
        <link rel="stylesheet" href="../../Font-Awesome-4.7.0/css/font-awesome.min.css">

	<!--===============================================================================================-->

</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark fixed-top">
        <div class="container">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="../index.php" class="mr-2 text-white fa fa-home fa-2x"></a>
                    </li>
<?php 
    $id = $_GET['id'];

    if ($login == 'admin'){
        echo '<li class="nav-item">';
        echo '<a href="ajouter_lot.php?id='.$id.'" class="nav-link text-white ml-2">Ajouter Lot Produit</a>';
        echo '</li>';
        echo '<li class="nav-item">';
        echo '<a href="lot_produit.php?id='.$id.'" class="nav-link ml-3 text-white ">Lot</a>';
        echo '</li>';
    } 

    if($login){
        echo '<li class="nav-item">';
        echo '<a href="../logout.php" class="nav-link text-white ml-3 ">Deconnect</a>';
        echo '</li>';
    }
?>
                
                </ul>
            </div>
        </div>
    </nav>
   
    <div class="mt-3">
        <div class="container-fluid ">
            <div class="row p-5 ">

                <div class="col-md-12">
                    <h3 class="mt-5 ml-2 mb-2 text-center">Liste des Lots de produit:</h3>
                    <p class="text-center mt-3 ">
                        <em>
                        Il faut clique le nom de lot produit pour voir les detail
                        </em>
                    </p>
                    <div class="container">
                        <div class="row p-2">
<?php
    include "../db_connect.php";
    $sql = "SELECT * FROM lot_produit WHERE id_fk_produit = $id ; ";
    $result = mysqli_query($link, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo'<div class="bg-success m-2 p-2 rounded">';
                echo'<a href="../detail_produit/liste_detail.php?id='.$row['id_lot_produit'].'&idProduit='.$row['id_fk_produit'].'" class="text-white">';
                echo $row['nom_lot'];
                echo'</a>';
                echo'</div>';
            }

        }else {
            echo'<div class=" m-2 p-2">';
            echo'<p class="text-white text-center bg-danger p-3 rounded">';
            echo 'Le donne est vide ou il y a de eurreur';
            echo'</p>';
            echo'</div>';
        }
    }
    
?> 
                        </div>                       
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>

    <div class="container ">
        <h2 class="text-primary text-center">Detail de produit tout les lots</h2>
        <br>
        <div class="row">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Description</th>
                        <th scope="col">Debit</th>
                        <th scope="col">credit</th>
<?php 
    // if($login == 'admin'){
    //     echo '<th scope="col">';
    //     echo 'Action';
    //     echo '</th>';
    // }
?>
                           
                    </tr>
                </thead>

                <tbody>
<?php
    $myId = $_GET['id'];

    // Attempt select query execution
    $sql = "SELECT * FROM detail_produit 
            INNER JOIN lot_produit ON 
            detail_produit.id_fk_lot_produit = lot_produit.id_lot_produit
            WHERE id_fk_produit = '$myId' ORDER BY date_production DESC; ";
    // $sql = "SELECT * FROM `detail_produit` ORDER BY date_production DESC;";
    $result = mysqli_query($link, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $itertion = 0;
            $totalDebit = 0;
            $totalCredit = 0;
            
            while ($row = mysqli_fetch_array($result)) {
                $itertion ++;
                $totalDebit = $totalDebit + $row['debit'];
                $totalCredit = $totalCredit + $row['credit'];
                echo '<tr>';
                echo '<th scope="row">'.$itertion. '</th>';
                echo '<td>'.$row['description'].'</td>';
                echo '<td>'.$row['debit'].'</td>';
                echo '<td>'.$row['credit'].'</td>';
                // if ($login=='admin'){
                //     echo '<td>';
                //     echo '<a href="../detail_produit/afficher_detail.php?id=' . $row['id_produit'] . '&idLot='.$myId.'" class="mr-3" title="Afficher" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                //     echo '<a href="../detail_produit/modifier_detail.php?id=' .$row['id_produit'] . '&idLot='.$myId.'" class="mr-3" title="Modifier" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                //     echo '<a href="../detail_produit/supprimer_detail.php?id=' . $row['id_produit'] . '&idLot='.$myId.'" title="Supprimer" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                //     echo '</td>';
                // }
                echo '</tr>';
                
            }
            echo '<tr>';
            echo '<th scope="row"></th>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '</tr>';

            echo '<tr>';
            echo '<th scope="row">TOTAL</th>';
            echo '<td>------------------------</td>';
            echo '<td>'.$totalDebit.'</td>';
            echo '<td>'.$totalCredit.'</td>';
            echo '</tr>';

            echo '</tbody>';
            echo'</table>';
        } else {
            echo '</tbody>';
            echo'</table>';
            echo "<div class='alert alert-danger text-center h4 w-100'><em>Aucun enregistrement n'a été trouvé.</em></div>";
        }
    } else {
        echo "Oups! Quelque chose s'est mal passé. Veuillez réessayer plus tard.";
    }

    // Close connection
    $mysqli->close();
?>
         
        </div>    
    </div>

    <div class="container mt-5">
        <h2>Rapport</h2>
<?php
// $reste = $totalCredit - $totalDebit;
// if ($reste < 0){
//     echo 'PERDU';

// }else{
//     echo 'GAGNE';
// }
?>
    </div>
    
</body>
</html>
