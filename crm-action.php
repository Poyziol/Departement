<?php include('connexion.php'); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action CRM</title>
    <link rel="stylesheet" href="css/mainmenu.css">
    <link rel="stylesheet" href="css/headerfooter.css">
    <link rel="stylesheet" href="fontawsome/css/all.min.css">
    <link rel="stylesheet" href="css/image3.css">
    <style>
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin: 15px 0;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
        }

        form {
            max-width: 500px;
            margin: auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
        }

        form label {
            display: block;
            margin-top: 10px;
        }

        form input,
        form select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }

        form button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #efef27;
            color: black;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <?php include('header.php'); ?>

    <div id="container-main" class="form-container">
        <h1>Nouvelle action de l'entreprise</h1>

        <?php if (isset($_GET['success'])): ?>
            <div class="success-message">✅ Action enregistrée avec succès.</div>
        <?php endif; ?>

        <form action="traitement-action.php" method="POST">
            <!-- Sélection de la voiture -->
            <label for="voiture">Voiture :</label>
            <select name="id_voiture" id="voiture" required>
                <option value="">-- Choisir une voiture --</option>
                <?php
                try {
                    $sql = "SELECT id, modele, marque FROM voiture";
                    $stmt = pdo()->query($sql);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value=\"{$row['id']}\">{$row['marque']} {$row['modele']}</option>";
                    }
                } catch (PDOException $e) {
                    echo "<option disabled>Erreur chargement voiture</option>";
                }
                ?>
            </select>

            <!-- Sélection de l'action prédéfinie -->
            <label for="action">Type d'action :</label>
            <select name="id_liste_action" id="action" required>
                <option value="">-- Choisir une action --</option>
                <?php
                try {
                    $sql = "SELECT id, type_action, budget, effet FROM liste_action_entreprise";
                    $stmt = pdo()->query($sql);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $desc = "{$row['type_action']} (Budget: {$row['budget']} €, Effet: +{$row['effet']})";
                        echo "<option value=\"{$row['id']}\">$desc</option>";
                    }
                } catch (PDOException $e) {
                    echo "<option disabled>Erreur chargement action</option>";
                }
                ?>
            </select>

            <button type="submit">Enregistrer l'action</button>
        </form>

        <div class="form-footer">
            <a href="choix-action.php" class="btn-back">← Retour</a>
        </div>
    </div>

    <?php include('footer.php'); ?>

</body>

</html>