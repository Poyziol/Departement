DROP TABLE transaction_financiere;
DROP TABLE action_entreprise;
DROP TABLE reaction_client;
DROP TABLE liste_action_entreprise;
DROP TABLE voiture;
DROP TABLE categorie_voiture;

CREATE TABLE categorie_voiture(
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100)
);


CREATE TABLE voiture (
    id SERIAL PRIMARY KEY,
    id_categorie INT REFERENCES categorie_voiture(id), 
    modele VARCHAR(100),
    marque VARCHAR(100),
    prix NUMERIC(10,2)
);



CREATE TABLE reaction_client(
    id SERIAL PRIMARY KEY,
    id_voiture INT REFERENCES voiture(id),
    popularite INT DEFAULT 0
);

CREATE TABLE liste_action_entreprise(
    id SERIAL PRIMARY KEY,
    type_action VARCHAR(100), -- Ex: "Car Show", "Promo", "Nouveau design"
    budget NUMERIC(12,2),
    effet INT
);

CREATE TABLE action_entreprise (
    id SERIAL PRIMARY KEY,
    id_voiture INT REFERENCES voiture(id),
    id_liste_action INT REFERENCES liste_action_entreprise(id)
);


CREATE TABLE transaction_financiere (
    id SERIAL PRIMARY KEY,
    type_transaction VARCHAR(50) CHECK (type_transaction IN ('Depense', 'Revenu')),
    description TEXT,
    montant NUMERIC(12,2) NOT NULL,
    date_transaction DATE DEFAULT CURRENT_DATE,
    id_action INT REFERENCES action_entreprise(id)  -- NULLABLE, si la transaction est liée à une action
);



