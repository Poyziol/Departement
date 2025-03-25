<?php
include('connexion.php');

// Récupérer les départements
$stmt = $pdo->query("SELECT id, nom FROM departements");
$departements = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulaire-PDF</title>
    <link rel="stylesheet" href="css/formulaire.css">
    <link rel="stylesheet" href="css/headerfooter.css">
</head>
<body>

    <?php 
        include('header.php');
    ?>

    <div id="container-main">
        <h1>Choix Département pour le PDF</h1>
        <div id="container-input">
            <form action="pdf.php" method="post">
                <label for="id-selection"><h3>Choisir un département :</h3></label>
                <select name="departement" id="id-selection" required>
                    <option value="">-- Sélectionnez --</option>
                    <?php foreach ($departements as $d) : ?>
                        <option value="<?= htmlspecialchars($d['id']) ?>"><?= htmlspecialchars($d['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
                <button>Valider</button>
            </form>
        </div>
        <a href="home.php">Retour</a>
    </div>

    <?php 
        include('footer.php');
    ?>

</body>
</html>