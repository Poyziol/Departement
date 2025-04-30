<?php
    require_once('fonction.php'); 
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
        <table border="1">
            <tr>
                <th>Modèle</th>
                <th>Marque</th>
                <th>Popularité</th>
            </tr>
            <?php
            $sql = "SELECT v.modele, v.marque, rc.popularite
                    FROM reaction_client rc
                    JOIN voiture v ON rc.id_voiture = v.id";
            $stmt = pdo()->query($sql);

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>{$row['modele']}</td>
                        <td>{$row['marque']}</td>
                        <td>{$row['popularite']}</td>
                      </tr>";
            }
            ?>
        </table>
    </div>

    <?php include('footer.php'); ?>

</body>
</html>
