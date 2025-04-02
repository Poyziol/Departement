<?php 
session_start();
$id=$_SESSION['departement'];
include("connexion.php");
    $dep=$_POST["departement"];
    $cat=$_POST["categorie"];
    $prev=$_POST["prev"];
    $real=$_POST["real"];
    $date=$_POST["date"];
// if($id==2){
//     if($dep==1 || $dep==3){
//         header('location:formulaire-insertion.php?erreur=1');
//     }
// }
// if($id==3){
//     if($dep==1 || $dep==2){
//         header('location:formulaire-insertion.php?erreur=1');
//     }
if($id!=1){
    header('location:formulaire-insertion.php?erreur=1');

}else{
    $sql = "INSERT INTO budgets (departement_id, categorie_id, prevision, realisation, date_periode) VALUES ($dep,$cat,$prev,$real,'$date')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    header('location:formulaire-insertion.php?succes=1');
}
?>