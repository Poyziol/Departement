<?php
function pdo(){
    $host = "localhost";
    $user = "postgres";
    $password = "postgres";
    $dbname = "etp";
    
    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } 
    catch(PDOException $e) 
    {
        return null;
        die("Erreur de connexion : " . $e->getMessage());
    }
}

function getSoldeActuel() {
    $pdo = pdo();
    $sql = "SELECT COALESCE(SUM(CASE WHEN type_transaction = 'Revenu' THEN montant ELSE -montant END), 0) AS solde_actuel FROM transaction_financiere";

    $stmt = $pdo->query($sql);
    $result = $stmt->fetch();
    return $result['solde_actuel'];
}


function listerCategorie() {
    $pdo=pdo();
    $sql = "SELECT * FROM categories";

    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}
?>
