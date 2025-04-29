<?php
require_once('fonction.php');
include('connexion.php')
?>

<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action CRM</title>
    <link rel="stylesheet" href="css/mainmenu.css">
    <link rel="stylesheet" href="css/headerfooter.css">
    <link rel="stylesheet" href="fontawsome/css/all.min.css">
</head>
<style>
    .success-message {
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        margin: 15px 0;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
    }
</style>

<body>

    <?php include('header.php'); ?>

    <div id="container-main">
        <h1>Nouvelle Action de l'entreprise</h1>
        <?php if (isset($_GET['success'])): ?>
            <div class="success-message">✅ Action enregistrée avec succès.</div>
        <?php endif; ?>

        <form action="traitement-action.php" method="POST">
            <label for="voiture">Voiture :</label>
            <select name="id_voiture" id="voiture" required>
                <option value="">-- Choisir une voiture --</option>
                <?php
                $sql = "SELECT id, modele, marque FROM voiture";
                $stmt = pdo()->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=\"{$row['id']}\">{$row['marque']} {$row['modele']}</option>";
                }
                ?>
            </select><br><br>

            <label for="type_action">Type d'action :</label>
            <input type="text" id="type_action" name="type_action" placeholder="Ex: Car Show, Promo..." required><br><br>

            <label for="budget">Budget (€) :</label>
            <input type="number" id="budget" name="budget" step="0.01" required><br><br>

            <label for="effet">Effet estimé (+ popularité) :</label>
            <input type="number" id="effet" name="effet" required><br><br>

            <button type="submit">Enregistrer l'action</button>
        </form>
    </div>

    <?php include('footer.php'); ?>

</body>

</html>