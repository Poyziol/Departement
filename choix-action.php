
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
        <h1>Choix d'Action</h1>
        <div class="container-button">
            <form action="insertion.php">
                <button>Insertion Action</button>
            </form>
            <form action="crm-action.php">
                <button>Faire une Action</button>
            </form>
        </div>
        <a href="home.php">Retour</a>
    </div>

    <?php
     include("footer.php");
    ?>

</body>

</html>