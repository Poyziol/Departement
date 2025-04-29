<?php
    include('connexion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reaction CRM</title>
    <link rel="stylesheet" href="css/mainmenu.css">
    <link rel="stylesheet" href="css/headerfooter.css">
    <link rel="stylesheet" href="fontawsome/css/all.min.css">
</head>
<body>

<?php include('header.php'); ?>

<div id="container-main">
    <h1>Réactions des clients</h1>

    <?php
    $sql = "SELECT cv.nom AS categorie, v.modele, v.marque, rc.popularite
            FROM reaction_client rc
            JOIN voiture v ON rc.id_voiture = v.id
            JOIN categorie_voiture cv ON v.id_categorie = cv.id
            ORDER BY cv.nom, v.modele";

    $stmt = pdo()->query($sql);

    $currentCategorie = null;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($currentCategorie !== $row['categorie']) {
            if ($currentCategorie !== null) {
                echo "</table><br>"; // Ferme la table précédente
            }

            $currentCategorie = $row['categorie'];
            echo "<h2>{$currentCategorie}</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>Modèle</th>
                        <th>Marque</th>
                        <th>Popularité</th>
                    </tr>";
        }

        echo "<tr>
                <td>{$row['modele']}</td>
                <td>{$row['marque']}</td>
                <td>{$row['popularite']}</td>
              </tr>";
    }

    if ($currentCategorie !== null) {
        echo "</table>"; // Ferme la dernière table
    }
    ?>
</div>

<?php include('footer.php'); ?>

</body>
</html>
