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

            $sql = "SELECT c.categorie, SUM(rc.popularite) AS total_popularite
                    FROM reaction_client1 rc
                    JOIN categorie_client c ON rc.id_client = c.id_client
                    GROUP BY c.categorie
                    ORDER BY c.categorie";

            $stmt = pdo()->query($sql);

            $labels = [];
            $data = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $labels[] = $row['categorie'];
                $data[] = (int)$row['total_popularite'];
            }
        ?>

    <h2>Popularité par catégorie de client</h2>
    <canvas id="populariteChart" width="<?= max(800, count($labels)*80) ?>" height="400"></canvas>

    <div style="text-align: center; margin-top: 20px;">
        <a href="choix-action1.php" class="btn-back">← Retour</a>
    </div>

    <script>
        const ctx = document.getElementById('populariteChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($labels) ?>,
                datasets: [{
                    label: 'Voitures Achetés',
                    data: <?= json_encode($data) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Nombre de voiture/mois'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Catégorie de client'
                        }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: { mode: 'index', intersect: false }
                }
            }
        });
    </script>
</body>
</html>

        </body>
        <?php include("footer.php"); ?>
</html>
