INSERT INTO categorie_voiture (nom) VALUES
('SUV'), ('Berline'), ('Citadine'), ('Coupé'), ('Cabriolet'),
('Pickup'), ('Monospace'), ('Break'), ('Hybride'), ('Électrique'),
('Utilitaire'), ('Sportive');


INSERT INTO voiture (id_categorie, modele, marque, prix) VALUES
(1, 'Rav4', 'Toyota', 35000.00),
(2, 'Classe C', 'Mercedes', 42000.00),
(3, '208', 'Peugeot', 20000.00),
(4, 'Mustang', 'Ford', 45000.00),
(5, 'Z4', 'BMW', 55000.00),
(6, 'Hilux', 'Toyota', 33000.00),
(7, 'Scénic', 'Renault', 27000.00),
(8, 'Passat SW', 'Volkswagen', 32000.00),
(9, 'Prius', 'Toyota', 31000.00),
(10, 'Model 3', 'Tesla', 48000.00),
(11, 'Partner', 'Peugeot', 25000.00),
(12, '911', 'Porsche', 90000.00);


INSERT INTO reaction_client (id_voiture, popularite) VALUES
(1, 75), (2, 60), (3, 90),
(4, 85), (5, 70), (6, 65),
(7, 55), (8, 60), (9, 88),
(10, 95), (11, 50), (12, 92);


INSERT INTO liste_action_entreprise (type_action, budget, effet) VALUES
('Car Show', 5000.00, 15),
('Promo', 3000.00, 20),
('Nouveau design', 8000.00, 25),
('Test Drive Event', 4500.00, 18),
('Publicité TV', 10000.00, 30);


INSERT INTO action_entreprise (id_voiture, id_liste_action) VALUES
(1, 1), (2, 2), (3, 3),
(4, 2), (5, 1), (6, 3),
(7, 4), (8, 5), (9, 1),
(10, 2), (11, 3), (12, 1);

INSERT INTO transaction_financiere (type_transaction, description, montant, id_action) VALUES
('Depense', 'Organisation Car Show pour Rav4', 5000.00, 1),
('Depense', 'Promotion pour Classe C', 3000.00, 2),
('Depense', 'Design amélioré pour 208', 8000.00, 3),
('Depense', 'Promo Mustang', 3000.00, 4),
('Depense', 'Car Show Z4', 5000.00, 5),
('Depense', 'Design Hilux amélioré', 8000.00, 6),
('Depense', 'Test Drive Scénic', 4500.00, 7),
('Depense', 'Publicité TV Passat SW', 10000.00, 8),
('Depense', 'Car Show Prius', 5000.00, 9),
('Depense', 'Promo Model 3', 3000.00, 10),
('Depense', 'Nouveau design Partner', 8000.00, 11),
('Depense', 'Car Show 911', 5000.00, 12),
('Revenu', 'Vente de Rav4', 37000.00, NULL),
('Revenu', 'Vente de Model 3', 49000.00, NULL),
('Revenu', 'Vente de 911', 95000.00, NULL),
('Revenu', 'Vente de 208', 21000.00, NULL),
('Revenu', 'Vente de Mustang', 47000.00, NULL);
