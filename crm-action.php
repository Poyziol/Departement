<?php
    include('connexion.php');

    // Récupération des voitures, groupées par catégorie
    $sql = "SELECT v.id, v.modele, v.marque, c.nom AS categorie
            FROM voiture v
            JOIN categorie_voiture c ON v.id_categorie = c.id
            ORDER BY c.nom, v.marque, v.modele";
    $stmt = $pdo->query($sql);
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Récupération de toutes les actions CRM
    $sql2 = "SELECT id, id_voiture, type_action, budget FROM action_entreprise";
    $stmt2 = $pdo->query($sql2);
    $actions = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mainmenu.css">
    <link rel="stylesheet" href="css/headerfooter.css">
    <link rel="stylesheet" href="fontawsome/css/all.min.css">
    <link rel="stylesheet" href="crm-formulaire.css">
    <title>Action CRM</title>
</head>
<body>
    <?php include('header.php'); ?>

    <div id="container-main">
        <form action="traitement.php" method="get">
            <div>
                <label for="car-select">Voiture</label>
                <select name="voiture" id="car-select">
                    <option value="">--Choisissez une voiture--</option>
                    <?php
                    $currentCategory = '';
                    foreach ($cars as $car) {
                        if ($car['categorie'] !== $currentCategory) {
                            if ($currentCategory !== '') echo '</optgroup>';
                            $currentCategory = $car['categorie'];
                            echo '<optgroup label="'.htmlspecialchars($currentCategory).'">';
                        }
                        echo '<option value="'. $car['id'] .'">'. htmlspecialchars($car['marque'].' '. $car['modele']) .'</option>';
                    }
                    if ($currentCategory !== '') echo '</optgroup>';
                    ?>
                </select>
            </div>

            <div>
                <label for="action-select">Action CRM</label>
                <select name="action" id="action-select">
                    <option value="">--Choisissez une action--</option>
                </select>
            </div>

            <div>
                <label for="budget-display">Coût CRM (€)</label>
                <input type="text" id="budget-display" name="budget" readonly>
            </div>

            <button type="submit">Valider</button>
        </form>
    </div>

    <script>
        // Transfert des données PHP vers JavaScript
        const actions = <?php echo json_encode($actions, JSON_HEX_TAG); ?>;

        // Mise à jour de la liste d'actions en fonction de la voiture sélectionnée
        document.getElementById('car-select').addEventListener('change', function() {
            const carId = this.value;
            const actionSelect = document.getElementById('action-select');
            actionSelect.innerHTML = '<option value="">--Choisissez une action--</option>';
            actions.forEach(action => {
                if (action.id_voiture == carId) {
                    const opt = document.createElement('option');
                    opt.value = action.id;
                    opt.textContent = action.type_action;
                    opt.dataset.budget = action.budget;
                    actionSelect.appendChild(opt);
                }
            });
            document.getElementById('budget-display').value = '';
        });

        // Affichage du budget de l'action sélectionnée
        document.getElementById('action-select').addEventListener('change', function() {
            const sel = this.selectedOptions[0];
            document.getElementById('budget-display').value = sel ? sel.dataset.budget : '';
        });
    </script>

    <?php include('footer.php'); ?>
</body>
</html>