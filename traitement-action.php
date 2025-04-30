<?php
require_once('fonction.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_voiture = $_POST['id_voiture'];
    $type_action = $_POST['type_action'];
    $budget = $_POST['budget'];
    $effet = $_POST['effet'];

    // Insertion de l'action dans action_entreprise
    $sql = "INSERT INTO action_entreprise (id_voiture, type_action, budget, effet)
            VALUES (?, ?, ?, ?)";
    $stmt = pdo()->prepare($sql);
    $stmt->execute([$id_voiture, $type_action, $budget, $effet]);

    // Mise à jour de la popularité dans reaction_client (ou insertion si elle n'existe pas encore)
    $check = pdo()->prepare("SELECT id FROM reaction_client WHERE id_voiture = ?");
    $check->execute([$id_voiture]);

    if ($check->rowCount() > 0) {
        $update = pdo()->prepare("UPDATE reaction_client SET popularite = popularite + ? WHERE id_voiture = ?");
        $update->execute([$effet, $id_voiture]);
    } else {
        $insert = pdo()->prepare("INSERT INTO reaction_client (id_voiture, popularite) VALUES (?, ?)");
        $insert->execute([$id_voiture, $effet]);
    }

    // Redirection avec succès
    header("Location: crm-action.php?success=1");
    exit();
}
