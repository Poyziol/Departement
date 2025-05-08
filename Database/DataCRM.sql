-- 1. Catégories de voitures (15 entrées)
INSERT INTO categorie_voiture (id, nom) VALUES
(1, 'SUV'),
(2, 'Berline'),
(3, 'Citadine'),
(4, '4x4'),
(5, 'Pick-up'),
(6, 'Coupe'),
(7, 'Cabriolet'),
(8, 'Break'),
(9, 'Monospace'),
(10, 'Van'),
(11, 'Utilitaire'),
(12, 'Hybride'),
(13, 'electrique'),
(14, 'Sportive'),
(15, 'Luxe');

-- 2. Voitures (21 modèles)
INSERT INTO voiture (id, id_categorie, modele, marque, prix) VALUES
(1, 1, 'Rav4', 'Toyota', 35000.00),
(2, 2, 'Classe C', 'Mercedes', 42000.00),
(3, 3, '208', 'Peugeot', 20000.00),
(13, 4, 'Mustang', 'Ford', 45000.00),
(14, 5, 'Z4', 'BMW', 55000.00),
(15, 6, 'Hilux', 'Toyota', 33000.00),
(16, 7, 'Scenic', 'Renault', 27000.00),
(17, 8, 'Passat SW', 'Volkswagen', 32000.00),
(18, 9, 'Prius', 'Toyota', 31000.00),
(19, 10, 'Model 3', 'Tesla', 48000.00),
(20, 11, 'Partner', 'Peugeot', 25000.00),
(21, 12, '911', 'Porsche', 90000.00);

-- 3. Popularité des voitures
INSERT INTO reaction_client (id_voiture, popularite) VALUES
(1, 75), (2, 60), (3, 90), (13, 75), (14, 60), 
(15, 30), (16, 32), (17, 87), (18, 68), 
(19, 22), (20, 9), (21, 12);

-- 4. Catégories clients (15 types)
INSERT INTO categorie_client (id_client, categorie) VALUES
(1, 'Senior'),
(2, 'Adulte'),
(3, 'Jeune'),
(4, 'Mariée'),
(5, 'Célibataire'),
(6, 'etudiant'),
(7, 'Professionnel'),
(8, 'Parent'),
(9, 'Famille nombreuse'),
(10, 'Retraite'),
(11, 'Touriste'),
(12, 'Entrepreneur'),
(13, 'Handicape'),
(14, 'Fonctionnaire'),
(15, 'Sans emploi');

-- Insertion des réactions clients valides
INSERT INTO reaction_client1 (id_client, popularite) VALUES
-- Clients existants (1-15)
(1, 30),   -- Senior
(2, 45),   -- Adulte
(3, 20),   -- Jeune
(4, 25),   -- Mariée
(5, 35),   -- Célibataire
(1, 10),   -- Second vote Senior
(2, 20),   -- Second vote Adulte
(3, 30),   -- Second vote Jeune
(4, 15),   -- Second vote Mariée
(5, 25),   -- Second vote Célibataire
(11, 30),  -- Touriste
(15, 44),  -- Sans emploi
(10, 78),  -- Retraite
(10, 22),  -- Second vote Retraite
(8, 32),   -- Parent
(7, 11),   -- Professionnel
(6, 43),   -- Étudiant
(4, 22),   -- Troisième vote Mariée
(12, 15),  -- Entrepreneur
(13, 25);  -- Handicapé

-- 6. Types d'actions marketing
INSERT INTO liste_action_entreprise (id, type_action, budget, effet) VALUES
(1, 'Car Show', 5000.00, 15),
(2, 'Promo', 3000.00, 20),
(3, 'Nouveau design', 8000.00, 25);

-- 7. Actions réalisées
INSERT INTO action_entreprise (id, id_voiture, id_liste_action) VALUES
(1, 13, 1),  -- Action sur Mustang
(2, 14, 2),  -- Action sur Z4
(3, 15, 3);  -- Action sur Hilux

-- 8. Transactions financières
INSERT INTO transaction_financiere (id, type_transaction, description, montant, id_action) VALUES
(1, 'Depense', 'Organisation Car Show pour Mustang', 5000.00, 1),
(2, 'Depense', 'Promotion pour Z4', 3000.00, 2),
(3, 'Depense', 'Design Hilux ameliore', 8000.00, 3),
(4, 'Revenu', 'Vente de Mustang', 45000.00, NULL),
(5, 'Revenu', 'Vente de 208', 21000.00, NULL);


