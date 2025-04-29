INSERT INTO categorie_voiture (nom) VALUES
('Citadine'),
('Berline'),
('SUV'),
('Classique'),
('electrique');

INSERT INTO voiture (id_categorie, modele, marque, prix) VALUES
(1, 'C3', 'Citroen', 17000.00),       -- Citadine
(4, '2CV', 'Citroen', 9500.00),       -- Classique
(1, 'Clio V', 'Renault', 18000.00),   -- Citadine
(1, '208', 'Peugeot', 19000.00),      -- Citadine
(2, 'Golf 8', 'Volkswagen', 25000.00),-- Berline
(3, 'Tiguan', 'Volkswagen', 32000.00),-- SUV
(5, 'Model 3', 'Tesla', 43000.00);    -- Électrique


INSERT INTO reaction_client (id_voiture, popularite) VALUES
(1, 2),  -- C3
(2, 1),  -- 2CV
(3, 4),  -- Clio V
(4, 5),  -- 208
(5, 3),  -- Golf 8
(6, 4),  -- Tiguan
(7, 5);  -- Model 3


INSERT INTO action_entreprise (id_voiture, type_action, budget, effet) VALUES
(1, 'Amelioration design', 3000.00, 4),
(2, 'Exposition Car Show', 5000.00, 3),
(3, 'Publicite TV', 7000.00, 5),
(5, 'Réduction prix 5%', 2000.00, 4),
(7, 'Campagne Réseaux sociaux', 8000.00, 5);

