<?php
include("connexion.php");

if (isset(($_FILES["csv_file"]))) {
    $fileName = $_FILES["csv_file"]["tmp_name"];


    if ($_FILES["csv_file"]["size"] > 0) {
        $file = fopen($fileName, "r");
        fgetcsv($file); // Ignore la première ligne (entête CSV)

        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $dep = intval($column[0]);
            $cat = intval($column[1]);
            $prev = intval($column[2]);
            $real = intval($column[3]);
            $date = $column[4];

            // Éviter les doublons avec `ON DUPLICATE KEY UPDATE`
            $sql = "INSERT INTO budgets (departement_id, categorie_id, prevision, realisation, date_periode) VALUES ($dep,$cat,$prev,$real,'$date')";
          

            $pdo->query($sql);
        }
        fclose($file);
        echo "Importation réussie !";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/formulaire.css">
    <link rel="stylesheet" href="css/headerfooter.css">
    <link rel="stylesheet" href="fontawsome/css/all.min.css">
    <title>Import CSV</title>
</head>
<body>

    <?php 
        include('header.php');
    ?>

    <div id="container-main">
        <h1>Choix CSV</h1>
        <div id="container-input">
            <form action="csv.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="csv_file" accept=".csv" required>
            <button>Importer</button>
            </form>
        </div>
        <a href="home.php">Retour</a>
    </div>

    <?php 
        include('footer.php');
    ?>
</body>
</html>

