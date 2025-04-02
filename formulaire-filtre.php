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
        <h1>Filtrage Par date</h1>
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
        <form action="affichagepardate.php" method="POST">
                <label for="id-departement">Departement: </label><br>
                <select name="departement" id="id-departement">
                    <?php foreach ($departements as $d) : ?>
                        <option value="<?= htmlspecialchars($d['id']) ?>"><?= htmlspecialchars($d['nom']) ?></option>
                    <?php endforeach; ?>
                </select><br><br>
                <label for="">Date Debut :</label><br>
                <input type="date" name="deut" placeholder="ex: 210000.00"><br><br>
                <label for="">Date Fon :</label><br>
                <input type="date" name="fin" placeholder="ex: 210000.00"><br><br>
                <button>Filtrer par date</button>
                <br>
            </form>
        </div>
    </div>

    <?php 
        include('footer.php');
    ?>

</body>

</html>


