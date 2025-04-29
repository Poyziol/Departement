<?php
require_once('fonction.php');

if (isset($_POST['montant'])) {
    $montant = floatval($_POST['montant']);
    $pdo = pdo();
    $pdo->exec("INSERT INTO transaction_financiere 
    (
    type_transaction,
    description,
    montant
    ) VALUES ('Revenu','Recharge',$montant)");
    header('Location: fm-recharge.php?success=1');
    exit;
}
?>
