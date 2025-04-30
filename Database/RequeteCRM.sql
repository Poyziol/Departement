--Pour voir le solde actuel
SELECT 
    SUM(CASE WHEN type_transaction = 'Revenu' THEN montant ELSE -montant END) AS solde_actuel
FROM transactions_financieres;
