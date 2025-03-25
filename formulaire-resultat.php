<?php 
    include('connexion.php');

    $stmt = $pdo->query("SELECT id, nom FROM departements");
    $departements = $stmt->fetchAll();
?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/formulaire.css">
    <link rel="stylesheet" href="css/headerfooter.css">

    <title>Formulaire-PDF</title>

</head>

<body>

    <?php 
        include('header.php');
    ?>

    <div id="container-main">
        <h1>Choix Departement pour le resultat</h1>
        <div id="container-input">
            <form action="" method="post">
                <label for="id-selection"><h3>Veuillez choisir un departement parmis ceux existants</h3></label>
                <select name="departement" id="id-selection">
                    <?php 
                        foreach($departements as $d) { ?>
                        <option value="<?= htmlspecialchars($d['id']) ?>"><?= htmlspecialchars($d['nom']) ?></option>
                    <?php } ?>
                </select>
                <button>Valider</button>
            </form>
        </div>
        <a href="choix-resultat.php">Retour</a>
    </div>

    <?php 
        include('footer.php');
    ?>

</body>

</html>