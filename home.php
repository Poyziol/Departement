<?php 
    session_start();
?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mainmenu.css">
    <link rel="stylesheet" href="css/headerfooter.css">

    <title>Main Menu</title>

</head>

<body>

    <?php 
        include('header.php');
    ?>

    <div id="container-main">
        <h1>Main Menu</h1>
        <div id="container-button">
            <form action="choix-insertion.php">
                <button>Insertion</button>
            </form>
            <form action="formulaire-filtre.php">
                <button>Filtrer budgets</button>
            </form>
            <form action="choix-resultat.php">
                <button>Voir Resultats finacieres</button>
            </form>
            <form action="formulaire-pdf.php">
                <button>Voir en PDF</button>
            </form>
        </div>
    </div>

    <?php 
        include('footer.php');
    ?>

</body>

</html>