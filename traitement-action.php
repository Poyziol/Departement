<?php
require_once('fonction.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_voiture = $_POST['id_voiture'];
    $id_liste_action = $_POST['id_liste_action'];

    $pdo = pdo();

    // Insérer dans action_entreprise
    $sql = "INSERT INTO action_entreprise (id_voiture, id_liste_action) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_voiture, $id_liste_action]);

    // Récupérer l'effet correspondant à cette action
    $sql_effet = "SELECT effet FROM liste_action_entreprise WHERE id = ?";
    $stmt_effet = $pdo->prepare($sql_effet);
    $stmt_effet->execute([$id_liste_action]);
    $effet = $stmt_effet->fetchColumn();

    // Vérifier si une ligne existe déjà dans reaction_client
    $check = $pdo->prepare("SELECT id FROM reaction_client WHERE id_voiture = ?");
    $check->execute([$id_voiture]);

    if ($check->rowCount() > 0) {
        $update = $pdo->prepare("UPDATE reaction_client SET popularite = popularite + ? WHERE id_voiture = ?");
        $update->execute([$effet, $id_voiture]);
    } else {
        $insert = $pdo->prepare("INSERT INTO reaction_client (id_voiture, popularite) VALUES (?, ?)");
        $insert->execute([$id_voiture, $effet]);
    }

    // Redirection avec succès
    header("Location: crm-action.php?success=1");
    exit();
}
