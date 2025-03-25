<?php
    session_start();
    include('connexion.php');
    $stmt = $pdo->query("SELECT nom FROM departements");
    $departements = $stmt->fetchAll();

    $departement = $_GET['departement'];
    if(in_array($departement,$departements))
    {
        $_SESSION['departement'] = $departement;
        header('Location: home.php');
    }

    header('Location: index.php?num=1');
?>