<?php
function pdo(){
    $host = "localhost";
    $user = "postgres";
    $password = "a";
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
function listerCategorie() {
    $pdo=pdo();
    $sql = "SELECT * FROM categories";

    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}
?>
