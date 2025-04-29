<?php
include("connexion.php");
$departement_id = isset($_GET['departement_id']) ? $_GET['departement_id'] : 1;
$date_debut = isset($_GET['debut']) ? $_GET['debut'] : '2023-01-01';
$date_fin = isset($_GET['fin']) ? $_GET['fin'] : '2023-12-31';

$query = "SELECT b.id, d.nom as departement, c.nom as categorie, c.nature, b.prevision, b.realisation, b.ecart, b.date_periode 
          FROM budgets b 
          JOIN departements d ON b.departement_id = d.id 
          JOIN categories c ON b.categorie_id = c.id 
          WHERE b.departement_id = :departement_id AND b.date_periode BETWEEN :date_debut AND :date_fin";
$statement = $pdo->prepare($query);
$statement->execute(['departement_id' => $departement_id, 'date_debut' => $date_debut, 'date_fin' => $date_fin]);
$budgets = $statement->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT t.id, t.montant, tc.nom as type_categorie, t.date_transaction 
          FROM transactions t 
          JOIN budgets b ON t.budget_id = b.id 
          JOIN type_categories tc ON t.type_categories_id = tc.id 
          WHERE b.departement_id = :departement_id AND t.date_transaction BETWEEN :date_debut AND :date_fin";
$statement = $pdo->prepare($query);
$statement->execute(['departement_id' => $departement_id, 'date_debut' => $date_debut, 'date_fin' => $date_fin]);
$transactions = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budgets et Transactions</title>
    <link rel="stylesheet" href="css/headerfooter.css">
    <link rel="stylesheet" href="fontawsome/css/all.min.css">
    <link href="bootstrap-offline-docs-5.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php 
        include('header.php');
    ?>
<body>
    <div class="container mt-4">
        <h2>Gestion des Budgets et Transactions</h2>
        <h3>Budgets</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Département</th>
                    <th>Catégorie</th>
                    <th>Nature</th>
                    <th>Prévision</th>
                    <th>Réalisation</th>
                    <th>Écart</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($budgets as $budget): ?>
                    <tr>
                        <td><?= htmlspecialchars($budget['departement']) ?></td>
                        <td><?= htmlspecialchars($budget['categorie']) ?></td>
                        <td><?= htmlspecialchars($budget['nature']) ?></td>
                        <td><?= number_format($budget['prevision'], 2) ?> Ar</td>
                        <td><?= number_format($budget['realisation'], 2) ?> Ar</td>
                        <td><?= number_format($budget['ecart'], 2) ?> Ar</td>
                        <td><?= htmlspecialchars($budget['date_periode']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <h3>Transactions</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Montant</th>
                    <th>Type</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td><?= htmlspecialchars($transaction['id']) ?></td>
                        <td><?= number_format($transaction['montant'], 2) ?> Ar</td>
                        <td><?= htmlspecialchars($transaction['type_categorie']) ?></td>
                        <td><?= htmlspecialchars($transaction['date_transaction']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
<?php 
        include('footer.php');
    ?>
</html>
