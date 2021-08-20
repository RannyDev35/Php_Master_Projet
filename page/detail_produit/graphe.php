<?php
require_once("../../jpgraph/jpgraph.php");
require_once("../../jpgraph/jpgraph_bar.php");
$date = date("Y");
$id = $_GET['id'];
$prix = $_GET['prix'];

$donnees = array(0,0,0,0,0,0,0,0,0,0,0,0);
$abscisses = array('Janvier','Fevrier','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Decembre');

include "../db_connect.php";
// echo $db;
$sql = "SELECT month(date_production) AS mois,SUM(debit) AS totalDebi,SUM(credit) AS totalCredit FROM detail_produit
        WHERE year(date_production) = '$date' AND id_fk_lot_produit = '$id' GROUP BY mois ORDER BY mois ASC";

$result = mysqli_query($link, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $donnees[$row['mois']-1] = $row["$prix"];
            
        }
    }     
    // echo 'ok';
}

$largeur = 1000;
$hauteur = 600;

// Initialisation du graphique
$graphe = new Graph($largeur, $hauteur);
// Valeurs min et max seront determinees automatiquement
$graphe->setScale("textlin");

// Echelle lineaire ('lin') en ordonnee et pas de valeur en abscisse ('text')
$graphe->xaxis->SetTickLabels($abscisses);

// Creation de l'histogramme
$histo = new BarPlot($donnees);
// $valeur = new LinePlot($donn);
// Ajout de l'histogramme au graphique
$graphe->add($histo);
// $graphe->add($valeur);

// Ajout du titre du graphique
$graphe->title->set("Representation de graphe de l' anne $date");

// Affichage du graphique
$graphe->stroke();
?>