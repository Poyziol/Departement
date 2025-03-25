
<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mainmenu.css">
    <link rel="stylesheet" href="css/headerfooter.css">

    <title>Choix resultat</title>

</head>

<body>

    <?php 
        include('header.php');
    ?>

    <div id="container-main">
        <h1>Choix type de resultat</h1>
        <div id="container-button">
            <form action="resultat-all.php">
                <button>Voir pour tous les departements</button>
            </form>
            <form action="formulaire-resultat.php">
                <button>Choisir un departement en particulier</button>
            </form>
        </div>
        <a href="home.php">Retour</a>
    </div>

    <?php 
        include('footer.php');
    ?>

</body>

</html>