<?php

?>

<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Graphique de popularité</title>
            <link rel="stylesheet" href="css/mainmenu.css">
            <link rel="stylesheet" href="css/headerfooter.css">
            <link rel="stylesheet" href="fontawsome/css/all.min.css">
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <style>
                body { font-family: Arial, sans-serif; }
                canvas { max-width: 100%; }
            </style>
        </head>

        <body>
            <?php
             include("header.php");

             $sql = "SELECT cv.nom AS categorie, v.modele, rc.popularite
             FROM reaction_client rc
             JOIN voiture v ON rc.id_voiture = v.id
             JOIN categorie_voiture cv ON v.id_categorie = cv.id
             ORDER BY cv.nom, v.modele";

             $stmt = pdo()->query($sql);
             
             // Préparation des données
             $labels = [];
             $categories = [];
             $donnees = []; // [categorie][modele] => popularité
             
             while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                 $modele = $row['modele'];
                 $categorie = $row['categorie'];
                 $popularite = (int)$row['popularite'];
             
                 $fullLabel = $modele . " ({$categorie})";
                 $labels[] = $fullLabel;
             
                 if (!isset($categories[$categorie])) {
                     $categories[$categorie] = [];
                 }
             
                 $categories[$categorie][$fullLabel] = $popularite;
             }
             
             // Palette de couleurs simple
             $couleurs = [
                 'SUV' => 'rgba(75, 192, 192, 0.7)',
                 'Berline' => 'rgba(255, 99, 132, 0.7)',
                 '4x4' => 'rgba(54, 162, 235, 0.7)',
                 'Pick-up' => 'rgba(255, 206, 86, 0.7)',
                 'Default' => 'rgba(201, 203, 207, 0.7)'
             ];
             
             // Générer les datasets
             $datasets = [];
             foreach ($categories as $cat => $voitures) {
                 $data = [];
                 foreach ($labels as $lbl) {
                     $data[] = $voitures[$lbl] ?? 0;
                 }
                 $datasets[] = [
                     'label' => $cat,
                     'data' => $data,
                     'backgroundColor' => $couleurs[$cat] ?? $couleurs['Default']
                 ];
             }
            ?>

            <h2>Popularité des voitures par catégorie</h2>
            <canvas id="populariteChart" width="<?= max(800, count($labels)*80) ?>" height="400"></canvas>

            <div style="text-align: center">
                <a href="home.php">Retour</a>
            </div>

            <?php 
                include('footer.php'); 
            ?>

            <script>
                const ctx = document.getElementById('populariteChart').getContext('2d');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?= json_encode($labels) ?>,
                        datasets: <?= json_encode($datasets) ?>
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Voitures (Modèle + Catégorie)'
                                },
                                ticks: {
                                    maxRotation: 60,
                                    minRotation: 60
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Popularité'
                                }
                            }
                        },
                        plugins: {
                            legend: { position: 'top' },
                            tooltip: { mode: 'index', intersect: false }
                        }
                    }
                });
            </script>
        </body>
</html>
