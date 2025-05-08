<?php 
    session_start();
    $departement = $_SESSION['departement'];
?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mainmenu.css">
    <link rel="stylesheet" href="css/headerfooter.css">
    <link rel="stylesheet" href="fontawsome/css/all.min.css">
    <link rel="stylesheet" href="css/image2.css">

    <title>Main Menu</title>

</head>

<body>

    <?php 
      include('header.php');
    ?>

    <div id="container-main">
        <h1>Main Menu</h1>
        <h3>HR (Human Ressources)</h3>
        <div class="container-button">
            <form action="choix-insertion.php">
                <button type="submit">Insertion</button>
            </form>
            <form action="formulaire-filtre.php">
                <button type="submit">Filtrer budgets</button>
            </form>
            <form action="choix-resultat.php">
                <button type="submit">Voir Resultats financiers</button>
            </form>
            <form action="formulaire-pdf.php">
                <button type="submit">Voir en PDF</button>
            </form>
        </div>
        <h3>CRM (Customer RelationShip Management)</h3>
        <div class="container-button">
            <form action="choix-action1.php">
                <button type="submit">Réaction</button>
            </form>
            <form action="choix-action.php">
                <button type="submit">Action</button>
            </form>
        </div>
        <h3>FM (Financial Management)</h3>
        <div class="container-button">
            <form action="fm-recharge.php">
                <button type="submit">Recharge</button>
            </form>
        </div>
    </div>

    <?php 
        include('footer.php');
    ?>

</body>

</html>