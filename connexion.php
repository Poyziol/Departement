<?php

$host = "localhost";
$user = "postgres";
// $password = "123";
$password = "postgres";
$dbname = "etp";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch(PDOException $e) 
{
    die("Erreur de connexion : " . $e->getMessage());
}

?>