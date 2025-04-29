CREATE DATABASE etp;
\c etp;

DROP TABLE transactions;
DROP TABLE budgets;
DROP TABLE categories;
DROP TABLE type_categories;
DROP TABLE departements;

CREATE TABLE departements (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE type_categories(
    id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE categories (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    type_categories_id INT REFERENCES type_categories(id) ON DELETE CASCADE,
    nature VARCHAR(255) NOT NULL 
);

CREATE TABLE budgets (
    id SERIAL PRIMARY KEY,
    departement_id INT REFERENCES departements(id) ON DELETE CASCADE,
    categorie_id INT REFERENCES categories(id) ON DELETE CASCADE,
    prevision DECIMAL(15,2) NOT NULL,
    realisation DECIMAL(15,2) DEFAULT 0,
    ecart DECIMAL(15,2) DEFAULT 0,
    date_periode DATE NOT NULL
);

CREATE TABLE transactions (
    id SERIAL PRIMARY KEY,
    budget_id INT REFERENCES budgets(id) ON DELETE CASCADE,
    montant DECIMAL(15,2) NOT NULL,
    type_categories_id INT REFERENCES type_categories(id) ON DELETE CASCADE,
    date_transaction DATE NOT NULL
);


