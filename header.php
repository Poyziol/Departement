<?php 
include "fonction.php";
$solde_actuel = getSoldeActuel();
?>
<header>
    <div id="container-nav">
        <h2>Gestion d'entreprise</h2>
        <nav>
            <ul>
                <li><a href="#">Solde: <?= $solde_actuel ?></a></li>
                <li><a href="home.php"><i class="fa fa-home"></i></a></li>
                <li><a href="formulaire-insertion.php"><i class="fa fa-plus"></i></a></li>
                <li><a href="formulaire-filtre.php"><i class="fa fa-search"></i></a></li>
                <li><a href="choix-resultat.php"><i class="fa fa-list"></i></a></li>
            </ul>
        </nav>
    </div>
</header>