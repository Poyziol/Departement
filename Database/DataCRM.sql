-- Categories
INSERT INTO categorie_voiture (nom) VALUES
('SUV'), ('Berline'), ('Citadine');

-- Voitures
INSERT INTO voiture (id_categorie, modele, marque, prix) VALUES
(1, 'Rav4', 'Toyota', 35000.00),
(2, 'Classe C', 'Mercedes', 42000.00),
(3, '208', 'Peugeot', 20000.00);

-- Popularité
INSERT INTO reaction_client (id_voiture, popularite) VALUES
(1, 75),
(2, 60),
(3, 90);

-- Types d'actions (liste)
INSERT INTO liste_action_entreprise (type_action, budget, effet) VALUES
('Car Show', 5000.00, 15),
('Promo', 3000.00, 20),
('Nouveau design', 8000.00, 25);

-- Actions concrètes sur des voitures
INSERT INTO action_entreprise (id_voiture, id_liste_action) VALUES
(1, 1), -- Rav4, Car Show
(2, 2), -- Classe C, Promo
(3, 3); -- 208, Nouveau design

-- Transactions
INSERT INTO transaction_financiere (type_transaction, description, montant, id_action) VALUES
('Depense', 'Organisation Car Show pour Rav4', 5000.00, 1),
('Depense', 'Promotion pour Classe C', 3000.00, 2),
('Depense', 'Design 208 ameliore', 8000.00, 3),
('Revenu', 'Vente de Rav4', 37000.00, NULL),
('Revenu', 'Vente de 208', 21000.00, NULL);
