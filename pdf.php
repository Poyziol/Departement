<?php
require('fpdf186/fpdf.php');

// Connexion à la base de données
$host = "localhost";
$user = "postgres";
$password = "123";
$dbname = "etp";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Validation du département (vérifier que c'est un entier valide)
$departement_id = filter_input(INPUT_POST, 'departement', FILTER_VALIDATE_INT);

if (!$departement_id) {
    die("ID de département invalide ou non fourni.");
}

// ... [Le reste du code inchangé jusqu'à la requête] ...

// Récupérer les périodes (2 derniers mois)
$stmt = $pdo->prepare("
    SELECT DISTINCT date_trunc('month', date_periode) as periode 
    FROM budgets 
    WHERE departement_id = ?
    ORDER BY periode DESC 
    LIMIT 2
");
$stmt->execute([$departement_id]); // ✅ Maintenant $departement_id est un entier
$periodes = $stmt->fetchAll();

if (count($periodes) < 1) {
    die("Aucune période trouvée pour ce département.");
}

$periode1 = $periodes[0]['periode'] ?? null;
$periode2 = $periodes[1]['periode'] ?? null;

// Récupérer les catégories
$stmt = $pdo->query("
    SELECT c.*, tc.nom as type 
    FROM categories c
    JOIN type_categories tc ON c.type_categories_id = tc.id
");
$categories = $stmt->fetchAll();

// Organiser par type
$recettes = array_filter($categories, fn($c) => $c['type'] === 'Recette');
$depenses = array_filter($categories, fn($c) => $c['type'] === 'Depense');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial','BU',35);
        $this->Cell(0,5,'EntrepriseSARL',0,1,'L');

        $this->SetFont('Times','',15);
        $this->Ln();
        $this->SetTextColor(200,200,200);
        $this->Cell(0,5,'Gestion de projet de l entreprise SARL',0,0,'L');

        $this->SetFont('Arial','B', 15);
        $this->setTextColor(170,170,170);
        $this->cell(1,5,'Annee: ',0,1,'R');

        $this->SetFont('Arial','B',15);
        $this->SetTextColor(0,0,0);
        $this->Cell(0,5,'www.entreprisesarl.com',0,1,'L');
        $this->Ln(10);

        $this->SetFont('Times','B',20);
        $this->SetTextColor(90,90,250);
        $this->Cell(0,10,'TABLEAU DES BUDJETS ET RESULTATS',0,1,'C');
        $this->Ln();
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial','B',13);
$pdf->SetX(15);
$pdf->Cell(40,6,'Region: ',0,0,'L');
$pdf->SetFont('Arial','',13);
$pdf->Cell(80,6,'Antananarivo',0,1,'L');

$pdf->SetFont('Arial','B',13);
$pdf->SetX(15);
$pdf->Cell(40,6,'Entreprise:',0,0,'L');
$pdf->SetFont('Arial','',13);
$pdf->Cell(80,6,'SARL&Co',0,1,'L');

$pdf->SetFont('Arial','B',13);
$pdf->SetX(15);
$pdf->Cell(40,6,'Departement:',0,0,'L');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(80,6,'M1-informatique',0,1,'L');

$pdf->SetFont('Arial','B',13);
$pdf->SetX(15);
$pdf->Cell(40,12,'Resultats obtenues:',0,1,'L');
$pdf->Ln(10);

// Entêtes du tableau
$pdf->SetFont('Arial','B',12);
$pdf->Cell(60, 10, 'Rubrique', 1, 0, 'C');
$pdf->Cell(40, 10, 'Periodel', 1, 0, 'C');
$pdf->Cell(40, 10, 'Ecart', 1, 0, 'C');
$pdf->Cell(40, 10, 'Periode2', 1, 1, 'C');

// Sous-entêtes
$pdf->SetX(15);
$pdf->Cell(60, 10, '', 0);
$pdf->Cell(20, 10, 'Prevision', 1, 0, 'C');
$pdf->Cell(20, 10, 'Realisation', 1, 0, 'C');
$pdf->Cell(40, 10, '', 1);
$pdf->Cell(20, 10, 'Prevision', 1, 0, 'C');
$pdf->Cell(20, 10, 'Realisation', 1, 1, 'C');

// Solde début (exemple statique)
$pdf->Cell(60, 10, 'Solde debut', 1);
$pdf->Cell(20, 10, '1000', 1); // Prévision P1
$pdf->Cell(20, 10, '800', 1);  // Réalisation P1
$pdf->Cell(40, 10, '200', 1);  // Écart P1
$pdf->Cell(20, 10, '900', 1);  // Prévision P2
$pdf->Cell(20, 10, '700', 1, 1); // Réalisation P2

// Recettes
$pdf->Cell(60, 10, 'Categorie: Recette', 1, 1);
foreach ($recettes as $r) {
    $pdf->Cell(60, 10, $r['nom'], 1);
    $pdf->Cell(20, 10, $r['prevision'] ?? '-', 1);
    $pdf->Cell(20, 10, $r['realisation'] ?? '-', 1);
    $pdf->Cell(40, 10, ($r['prevision'] - $r['realisation']) ?? '-', 1);
    $pdf->Cell(20, 10, '-', 1); // Période 2 (exemple)
    $pdf->Cell(20, 10, '-', 1, 1);
}

// Depenses
$pdf->Cell(60, 10, 'Categorie: Depense', 1, 1);
foreach ($depenses as $d) {
    $pdf->Cell(60, 10, $d['nom'], 1);
    $pdf->Cell(20, 10, $d['prevision'] ?? '-', 1);
    $pdf->Cell(20, 10, $d['realisation'] ?? '-', 1);
    $pdf->Cell(40, 10, ($d['prevision'] - $d['realisation']) ?? '-', 1);
    $pdf->Cell(20, 10, '-', 1);
    $pdf->Cell(20, 10, '-', 1, 1);
}

// Solde fin (exemple)
$pdf->Cell(60, 10, 'Solde fin', 1);
$pdf->Cell(20, 10, '1000', 1);
$pdf->Cell(20, 10, '500', 1);
$pdf->Cell(40, 10, '500', 1);
$pdf->Cell(20, 10, '800', 1);
$pdf->Cell(20, 10, '300', 1, 1);

$pdf->Output();

?>
