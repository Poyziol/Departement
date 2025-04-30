<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'insertion d'action</title>
    <link rel="stylesheet" href="css/mainmenu.css">
    <link rel="stylesheet" href="css/headerfooter.css">
    <link rel="stylesheet" href="fontawsome/css/all.min.css">
    <link rel="stylesheet" href="css/image3.css">
</head>

<body>
    <?php include("header.php"); ?>

    <div id="container-main">
        <h2>Ajouter une action entreprise</h2>

        <?php if (isset($_GET["success"])): ?>
            <p style="color: green;">✅ Action enregistrée avec succès !</p>
        <?php endif; ?>

        <form method="POST" action="traitement-insertion-action.php" style="max-width: 400px;">
            <label for="type_action">Type d'action :</label><br>
            <input type="text" id="type_action" name="type_action" required><br><br>

            <label for="budget">Budget (Ar) :</label><br>
            <input type="number" step="0.01" id="budget" name="budget" required><br><br>

            <label for="effet">Effet estimé (en % d’augmentation de clients ou ventes) :</label><br>
            <input type="number" id="effet" name="effet" required><br><br>

            <button type="submit">Enregistrer</button>
        </form>
    </div>

    <?php include("footer.php"); ?>
</body>

</html>