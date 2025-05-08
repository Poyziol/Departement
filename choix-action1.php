
<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mainmenu.css">
    <link rel="stylesheet" href="css/headerfooter.css">
    <link rel="stylesheet" href="fontawsome/css/all.min.css">
    <link rel="stylesheet" href="css/image3.css">
    <title>Choix action</title>

</head>

<body>

    <?php
     include("header.php");
    ?>

    <div  id="container-main">
        <h1>Choix Categorie</h1>
        <div class="container-button">
            <form action="crm-reaction1.php">
                <button>Client</button>
            </form>
            <form action="crm-reaction.php">
                <button>Voiture</button>
            </form>
        </div>
        <div class="form-footer">
            <a href="home.php" class="btn-back">← Retour</a>
        </div>
    </div>

    <?php
     include("footer.php");
    ?>

</body>

</html>