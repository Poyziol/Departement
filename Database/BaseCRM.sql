CREATE TABLE voiture (
    id SERIAL PRIMARY KEY,
    modele VARCHAR(100),
    marque VARCHAR(100),
    prix NUMERIC(10,2)
);

CREATE TABLE reaction_client(
    id SERIAL PRIMARY KEY,
    id_voiture INT REFERENCES voiture(id),
    popularite INT DEFAULT 0
);

CREATE TABLE action_entreprise (
    id SERIAL PRIMARY KEY,
    id_voiture INT REFERENCES voiture(id),
    type_action VARCHAR(100), -- Ex: "Car Show", "Promo", "Nouveau design"
    budget NUMERIC(12,2),
    effet INT
);
