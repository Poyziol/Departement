<?php
    session_start();
    include('connexion.php');
    $stmt = $pdo->query("SELECT nom FROM departements");
    $departements = $stmt->fetchAll();

    $departement = $_POST['departement'];
    $_SESSION['departement'] = $departement;
    header('Location: home.php');
?>