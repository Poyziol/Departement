<?php
require_once('fonction.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $type_action = $_POST["type_action"];
    $budget = $_POST["budget"];
    $effet = $_POST["effet"];
    
    $pdo = pdo();

    // type_action VARCHAR(100), -- Ex: "Car Show", "Promo", "Nouveau design"
    // budget NUMERIC(12,2),
    // effet INT


    $sql_action = "INSERT INTO  liste_action_entreprise (type_action,budget,effet) VALUES (?, ?,?)";
    $stmt_action = $pdo->prepare($sql_action);
    $stmt_action->execute([$type_action,$budget,$effet]);
    

    //Redirection
    header("Location: formulaire-insertion-action.php?success=1");
    exit();
}
