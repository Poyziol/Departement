<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'insertion d'action</title>
    <link rel="stylesheet" href="css/mainmenu.css">
    <link rel="stylesheet" href="css/headerfooter.css">
    <link rel="stylesheet" href="fontawsome/css/all.min.css">
    <link rel="stylesheet" href="css/image3.css">
    <link rel="stylesheet" href="css/form-style.css">
</head>

<body>
    <?php include("header.php"); ?>

    <div id="container-main" class="form-container">
        <h2>Ajouter une action entreprise</h2>

        <?php if (isset($_GET["success"])): ?>
            <p class="success-message">✅ Action enregistrée avec succès !</p>
        <?php endif; ?>

        <form method="POST" action="traitement-insertion-action.php" class="form-card">
            <label for="type_action">Type d'action :</label>
            <input type="text" id="type_action" name="type_action" required>

            <label for="budget">Budget (Ar) :</label>
            <input type="number" step="0.01" id="budget" name="budget" required>

            <label for="effet">Effet estimé (% de croissance) :</label>
            <input type="number" id="effet" name="effet" required>

            <button type="submit">💾 Enregistrer</button>
        </form>

        <div class="form-footer">
            <a href="choix-action.php" class="btn-back">← Retour</a>
        </div>
    </div>

    <?php include("footer.php"); ?>
</body>

</html>
