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

    <title>Formulaire insertion</title>

</head>

<body>

    <?php 
        include('header.php');
    ?>

    <div id="container-main">
        <h1>Formulaire d'insertion de Budget</h1>
        <div id="container-input">
            <form action="" method="post">
                <label for="id-departement">Departement</label>
                <select name="departement" id="id-departement">
                    <?php foreach ($departements as $d) : ?>
                        <option value="<?= htmlspecialchars($d['id']) ?>"><?= htmlspecialchars($d['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
    </div>

    <?php 
        include('footer.php');
    ?>

</body>

</html>