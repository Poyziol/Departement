
<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mainmenu.css">
    <link rel="stylesheet" href="css/headerfooter.css">
    <link rel="stylesheet" href="fontawsome/css/all.min.css">

    <title>Choix insertion</title>

</head>

<body>

    <?php 
        include('header.php');
    ?>

    <div id="container-main">
        <h1>Choix type d insertion</h1>
        <div class="container-button">
            <form action="formulaire-insertion.php">
                <button>Par formulaire</button>
            </form>
            <form action="csv.php">
                <button>Par CSV</button>
            </form>
        </div>
        <a href="home.php">Retour</a>
    </div>

    <?php 
        include('footer.php');
    ?>

</body>

</html>