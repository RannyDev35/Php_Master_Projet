<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Detail Produit</title>

    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../../css/style.css">
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
        <link rel="stylesheet" href="../../Font-Awesome-4.7.0/css/font-awesome.min.css">
        <script src="../../js/jquery-3.5.1.min.js"></script>
        <script src="../../js/popper.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
        
        <style>
            .wrapper{
                width: 75%;
                margin: 0 auto;
                margin-top : 20px;
            }
        </style>
        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>

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
    session_start();
    if (isset($_SESSION['role'])) {
        $login = $_SESSION['role'];
    }
    $id = $_GET['id'];
    $idProduit = $_GET['idProduit'];
    echo '<li class="nav-item">';
    echo '<a href="ajouter_detail.php?id='.$id.'" class="nav-link text-white ml-2">Ajouter Detail Produit</a>';
    echo '</li>';
    
    echo '<li class="nav-item">';
    echo '<a href="../logout.php" class="nav-link text-white ml-3 ">Deconnect</a>';
    echo '</li>';
    echo '<li class="nav-item">';
    echo '<a href="../lot_produit/list_lot.php?id='.$idProduit.'" class="nav-link text-white ml-2">Retour au lot</a>';
    echo '</li>';
?>
                        
                        </ul>
                    </div>
                </div>
        </nav>
        <!-- <div class="wrapper"> -->
        <div class="container">
                
            <br>
            <h2 class="text-primary text-center mt-5">Detail de produit d'un lot</h2>
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
    if($login == 'admin'){
        echo '<th scope="col">';
        echo 'Action';
        echo '</th>';
    }
?>
                       
                        </tr>
                    </thead>

                    <tbody>
<?php

    include "../db_connect.php";
    $myId = $_GET['id'];

    // Attempt select query execution
    $sql = "SELECT * FROM `detail_produit` WHERE id_fk_lot_produit = $myId ORDER BY date_production DESC;";
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
                echo '<td>'.$row['debit'].' ar</td>';
                echo '<td>'.$row['credit'].' ar</td>';
                if ($login=='admin'){
                    echo '<td>';
                    echo '<a href="afficher_detail.php?id=' . $row['id_produit'] . '&idLot='.$myId.'" class="mr-3" title="Afficher" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                    echo '<a href="modifier_detail.php?id=' .$row['id_produit'] . '&idLot='.$myId.'" class="mr-3" title="Modifier" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                    echo '<a href="supprimer_detail.php?id=' . $row['id_produit'] . '&idLot='.$myId.'" title="Supprimer" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                    echo '</td>';
                }
                echo '</tr>';
               
            }
            echo '<tr>';
            echo '<th scope="row"></th>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '</tr>';

            echo '<tr>';
            echo '<th scope="row">TOTAL</th>';
            echo '<td>------------------------</td>';
            echo '<td>'.$totalDebit.' ar</td>';
            echo '<td>'.$totalCredit.' ar</td>';
            echo '<td></td>';

            echo '</tr>';

            echo '</tbody>';
            echo'</table>';
        } else {
            echo '</tbody>';
            echo'</table>';
            echo "<div class='alert alert-danger text-center h4 w-100'><em>Aucun enregistrement n'a ??t?? trouv??.</em></div>";
        }
    } else {
        echo "Oups! Quelque chose s'est mal pass??. Veuillez r??essayer plus tard.";
    }

    // Close connection
    $mysqli->close();
?>
                </table>
            </div>    
        </div>
        <h1>Rapport</h1>
    </body>
</html>