
<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mainmenu.css">
    <link rel="stylesheet" href="css/headerfooter.css">
    <link rel="stylesheet" href="fontawsome/css/all.min.css">

    <title>Choix resultat</title>

</head>

<body>

    <?php 
        include('header.php');
    ?>

    <div id="container-main">
        <h1>Choix type de resultat</h1>
        <div class="container-button">
            <form action="resultat-all.php">
                <button>Voir pour tous les departements</button>
            </form>
            <form action="formulaire-resultat.php">
                <button>Choisir un departement en particulier</button>
            </form>
        </div>
        <div class="form-footer">
            <a href="home.php" class="btn-back">← Retour</a>
        </div>
    </div>

    <?php 
        include('footer.php');
    ?>

</body>

</html>