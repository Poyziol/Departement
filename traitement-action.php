<?php
require_once('fonction.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_voiture = $_POST['id_voiture'];
    $id_liste_action = $_POST['id_liste_action'];

    $pdo = pdo();

    // 1. Insertion dans action_entreprise
    $sql = "INSERT INTO action_entreprise (id_voiture, id_liste_action) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_voiture, $id_liste_action]);
    $id_action = $pdo->lastInsertId(); // récupérer l'ID pour lien avec transaction

    // 2. Récupération des infos de l'action
    $sql_action = "SELECT * FROM liste_action_entreprise WHERE id = ?";
    $stmt_action = $pdo->prepare($sql_action);
    $stmt_action->execute([$id_liste_action]);
    $action = $stmt_action->fetch();

    // 3. Enregistrement de la transaction financière (dépense)
    $sql_finance = "INSERT INTO transaction_financiere 
                    (type_transaction, description, montant, id_action)
                    VALUES ('Depense', ?, ?, ?)";
    $stmt_finance = $pdo->prepare($sql_finance);
    $stmt_finance->execute([$action['type_action'], $action['budget'], $id_action]);

    // 4. Mise à jour ou insertion de la popularité dans reaction_client
    $check = $pdo->prepare("SELECT id FROM reaction_client WHERE id_voiture = ?");
    $check->execute([$id_voiture]);

    if ($check->rowCount() > 0) {
        $update = $pdo->prepare("UPDATE reaction_client SET popularite = popularite + ? WHERE id_voiture = ?");
        $update->execute([$action['effet'], $id_voiture]);
    } else {
        $insert = $pdo->prepare("INSERT INTO reaction_client (id_voiture, popularite) VALUES (?, ?)");
        $insert->execute([$id_voiture, $action['effet']]);
    }

    // 5. Redirection
    header("Location: crm-action.php?success=1");
    exit();
}
