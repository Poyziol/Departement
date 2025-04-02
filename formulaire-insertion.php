<?php 
    session_start();
    include('connexion.php');
    $stmt1 = $pdo->query("SELECT * FROM categories");
    $categorie=$stmt1->fetchAll();

    $stmt = $pdo->query("SELECT id, nom FROM departements");
    $departements = $stmt->fetchAll();
?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/formulaire.css">
    <link rel="stylesheet" href="css/headerfooter.css">
    <link rel="stylesheet" href="fontawsome/css/all.min.css">

    <title>Formulaire insertion</title>

</head>

<body>

    <?php 
        include('header.php');
    ?>
    <div id="container-main">
        <h1>Formulaire d'insertion de Budget</h1>
        <?php 
        if(isset($_GET["erreur"])){
        ?>
        <span style="color:red;">Vous n'avez pas acces a cette departement</span>
        <?php 
        }
        ?>
          <?php 
        if(isset($_GET["succes"])){
        ?>
        <span style="color:green;">Budget ajouter avec succes</span>
        <?php 
        }
        ?>
        
        <div id="container-input">
            <form action="traitement-insertion.php" method="POST">
                <label for="id-departement">Departement: </label><br>
                <select name="departement" id="id-departement">
                    <?php foreach ($departements as $d) : ?>
                        <option value="<?= htmlspecialchars($d['id']) ?>"><?= htmlspecialchars($d['nom']) ?></option>
                    <?php endforeach; ?>
                </select><br><br>
                <label for="">Categorie: </label> <br>
                <Select name="categorie">
                <?php foreach ($categorie as $c) : ?>
                    <option value="<?= htmlspecialchars($c['id']) ?>"><?= htmlspecialchars($c['nature']) ?></option>
                <?php endforeach; ?>
                </Select> <br><br>
                <label for="">Prevision :</label><br>
                <input type="number" name="prev" placeholder="ex: 210000.00"><br><br>
                <label for="">Realisation :</label><br>
                <input type="number" name="real" placeholder="ex: 210000.00"><br><br>
                <label for="">Date :</label> <br>
                <input type="date" name="date"><br><br>
                <button>Inserer Budget</button>
                <br>
            </form>
        </div>
    </div>

    <?php 
        include('footer.php');
    ?>

</body>

</html>