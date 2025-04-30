<?php 
    require_once('fonction.php');
    include('connexion.php') 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recharge du solde</title>
    <link rel="stylesheet" href="css/mainmenu.css">
    <link rel="stylesheet" href="css/headerfooter.css">
    <link rel="stylesheet" href="fontawsome/css/all.min.css">
    <link rel="stylesheet" href="css/input.css">
    <link rel="stylesheet" href="css/image1.css">
</head>
<body>

<?php include('header.php'); ?>

<div id="container-main">
    <h1>Recharge du solde</h1>

    <?php if (isset($_GET['success'])): ?>
        <div class="success-message">✅ Solde rechargé avec succès.</div>
    <?php endif; ?>

    <form action="traitement-recharge.php" method="POST">
        <div class="label-div">
            <label for="montant">Montant à recharger (€):</label>
        </div>
        <div class="input-div">
            <input type="number" name="montant" id="montant" step="0.01" required>
        </div>
        <button type="submit">Valider</button>
    </form>
</div>

<?php include('footer.php'); ?>

</body>
</html>
