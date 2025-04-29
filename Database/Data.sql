-- Insertion des départements
INSERT INTO departements (nom) VALUES 
('Administration'),
('Technique'),
('Finance');

-- Insertion des types de catégories
INSERT INTO type_categories (nom) VALUES 
('Urgente'),
('Importante'),
('Normale');

-- Insertion des catégories (Recette + Dépense) avec leurs types et descriptions
INSERT INTO categories (nom, type_categories_id, nature) VALUES
-- Recettes
('Recette', 1, 'Recettes urgentes'),
('Recette', 2, 'Recettes importantes'),
('Recette', 3, 'Recettes régulières'),
-- Dépenses
('Depense', 1, 'Dépenses urgentes'),
('Depense', 2, 'Dépenses importantes'),
('Depense', 3, 'Dépenses courantes');

-- Insertion des budgets pour le département "Administration"
INSERT INTO budgets (departement_id, categorie_id, prevision, realisation, date_periode) VALUES
(1, 1, 10000.00, 9500.00, '2023-01-01'), -- Mois 1
(1, 4, 8000.00, 8200.00, '2023-02-01'),  -- Mois 2
(1, 2, 15000.00, 16000.00, '2023-03-01'); -- Mois 3

-- Insertion des budgets pour le département "Technique"
INSERT INTO budgets (departement_id, categorie_id, prevision, realisation, date_periode) VALUES
(2, 3, 5000.00, 4800.00, '2023-01-01'),  -- Recette Normale
(2, 5, 20000.00, 21000.00, '2023-01-01'), -- Depense Importante
(2, 6, 3000.00, 2900.00, '2023-01-01');   -- Depense Normale

INSERT INTO budgets (departement_id, categorie_id, prevision, realisation, date_periode) VALUES
(2, 3, 5000.00, 4800.00, '2023-01-01'),  -- Mois 1
(2, 5, 20000.00, 21000.00, '2023-02-01'), -- Mois 2
(2, 6, 3000.00, 2900.00, '2023-03-01');   -- Mois 3

-- Insertion des transactions
INSERT INTO transactions (budget_id, montant, type_categories_id, date_transaction) VALUES
(1, 9500.00, 1, '2023-01-15'),  -- Recette Urgente
(2, 8200.00, 1, '2023-01-20'),   -- Depense Urgente
(5, 21000.00, 2, '2023-01-10');  -- Depense Importante


