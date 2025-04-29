<?php 
    include('connexion.php');

    $stmt = $pdo->query("SELECT id, nom FROM departements");
    $departements = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="fontawsome/css/all.min.css">
    <title>Document</title>
</head>
<body>
        
    <div class="container" id="container">
    	<div class="form-container sign-in-container">
    		<form action="traitement-login.php" method="GET">
    			<h1>Sign in</h1>
    			<div class="social-container">
    				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
    				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
    				<a href="#" class="social"><i class="fa-brands fa-instagram"></i></a>
    			</div>
    			<span>Enter your departement</span>
    			<input list="id-departement" name="departement">
                <datalist id="id-departement">
                    <?php foreach($departements as $departement) { ?>
                        <option value="<?= $departement['nom'] ?>">
                    <?php } ?>
                </datalist>
				<?php if(isset($_GET['num'])) { ?>
						<p style="color: red;">This departement doesn t exist</p>
					<?php } ?>
                <div class="policy">
                    <input type="checkbox" name="policy" id="id-policy">
                    <p> Agreement and privacy policy</p>
                </div>
    			<button>Sign In</button>
    		</form>
    	</div>
    	<div class="overlay-container">
    		<div class="overlay">
    			<div class="overlay-panel overlay-right">
    				<h1>Hello, Friend!</h1>
    				<p>Enter your personal details and start journey with us</p>
    			</div>
    		</div>
    	</div>
    </div>
    
    <footer>
    	<p>
    		ETU003247 - ETU003327 - ETU003254 - ETU00XXXX
    	</p>
    </footer>
    
</body>
</html>