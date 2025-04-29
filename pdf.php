<?php
session_start();
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

// Validation du département
$departement_id = filter_input(INPUT_POST, 'departement', FILTER_VALIDATE_INT);
if (!$departement_id) {
    die("ID de département invalide ou non fourni.");
}

// Récupération des données détaillées
$query_budgets = "
    SELECT 
        d.nom as departement,
        c.nom as categorie,
        c.nature,
        b.prevision,
        b.realisation,
        b.ecart,
        b.date_periode
    FROM budgets b
    JOIN departements d ON b.departement_id = d.id
    JOIN categories c ON b.categorie_id = c.id
    WHERE b.departement_id = ?
    ORDER BY b.date_periode DESC
";

$stmt = $pdo->prepare($query_budgets);
$stmt->execute([$departement_id]);
$budgets = $stmt->fetchAll();

$query_transactions = "
    SELECT 
        t.id,
        t.montant,
        tc.nom as type_categorie,
        t.date_transaction
    FROM transactions t
    JOIN budgets b ON t.budget_id = b.id
    JOIN type_categories tc ON t.type_categories_id = tc.id
    WHERE b.departement_id = ?
    ORDER BY t.date_transaction DESC
";

$stmt = $pdo->prepare($query_transactions);
$stmt->execute([$departement_id]);
$transactions = $stmt->fetchAll();

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
        $this->cell(1,5,'Annee: 2025',0,1,'R');

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

    function TableauBudgets($budgets)
    {
        $this->SetFont('Arial','B',14);
        $this->Cell(0, 10, 'Details des Budgets', 0, 1);
        $this->SetFont('Arial','B',12);
        
        // En-têtes
        $this->Cell(40, 10, 'Departement', 1, 0, 'C');
        $this->Cell(40, 10, 'Categorie', 1, 0, 'C');
        $this->Cell(30, 10, 'Nature', 1, 0, 'C');
        $this->Cell(30, 10, 'Prevision', 1, 0, 'C');
        $this->Cell(30, 10, 'Realisation', 1, 0, 'C');
        $this->Cell(30, 10, 'Ecart', 1, 0, 'C');
        $this->Cell(30, 10, 'Date', 1, 1, 'C');
        
        // Données
        $this->SetFont('Arial','',10);
        foreach ($budgets as $budget) {
            $this->Cell(40, 8, $budget['departement'], 1);
            $this->Cell(40, 8, $budget['categorie'], 1);
            $this->Cell(30, 8, $budget['nature'], 1);
            $this->Cell(30, 8, number_format($budget['prevision'], 2), 1, 0, 'R');
            $this->Cell(30, 8, number_format($budget['realisation'], 2), 1, 0, 'R');
            $this->Cell(30, 8, number_format($budget['ecart'], 2), 1, 0, 'R');
            $this->Cell(30, 8, date('d/m/Y', strtotime($budget['date_periode'])), 1, 1, 'C');
        }
        $this->Ln(10);
    }

    function TableauTransactions($transactions)
    {
        $this->SetFont('Arial','B',14);
        $this->Cell(0, 10, 'Details des Transactions', 0, 1);
        $this->SetFont('Arial','B',12);
        
        // En-têtes
        $this->Cell(30, 10, 'ID', 1, 0, 'C');
        $this->Cell(50, 10, 'Montant', 1, 0, 'C');
        $this->Cell(60, 10, 'Type', 1, 0, 'C');
        $this->Cell(50, 10, 'Date', 1, 1, 'C');
        
        // Données
        $this->SetFont('Arial','',10);
        foreach ($transactions as $transaction) {
            $this->Cell(30, 8, $transaction['id'], 1, 0, 'C');
            $this->Cell(50, 8, number_format($transaction['montant'], 2), 1, 0, 'R');
            $this->Cell(60, 8, $transaction['type_categorie'], 1);
            $this->Cell(50, 8, date('d/m/Y', strtotime($transaction['date_transaction'])), 1, 1, 'C');
        }
        $this->Ln(10);
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

// Informations de l'entête
$pdf->SetFont('Arial','B',13);
$pdf->SetX(15);
$pdf->Cell(40,6,'Departement:',0,0,'L');
$pdf->SetFont('Arial','',13);
$pdf->Cell(80,6,$_SESSION['departement'],0,1,'L');
$pdf->Ln(15);

$pdf->SetFont('Arial','B',13);
$pdf->SetX(15);
$pdf->Cell(40,12,'Resultats obtenues:',0,1,'L');
$pdf->Ln(10);

$pdf->TableauBudgets($budgets);
$pdf->TableauTransactions($transactions);

$pdf->Output();

?>
