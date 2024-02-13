CREATE DATABASE Production_The;
USE Production_The;
/***************** CREATIONS DES TABLES ***************/

CREATE TABLE Varietes_The (
    ID_Variete INT AUTO_INCREMENT PRIMARY KEY,
    Nom_Variete VARCHAR(255),
    Occupation_Pied DECIMAL(5,2),
    Rendement_Pied_Mois INT
);

CREATE TABLE Admins (
    ID_Admins INT PRIMARY KEY,
    Username VARCHAR(50),
    MDP VARCHAR(150)
);

CREATE TABLE Parcelles (
    ID_Parcelle INT AUTO_INCREMENT PRIMARY KEY,
    Numero_Parcelle VARCHAR(50),
    Surface_Hectare DECIMAL(5,2),
    ID_Variete INT,
    FOREIGN KEY (ID_Variete) REFERENCES Varietes_The(ID_Variete)
);

CREATE TABLE Cueilleurs (
    ID_Cueilleur INT PRIMARY KEY,
    Nom_Cueilleur VARCHAR(255),
    Genre CHAR(1),
    Date_Naissance DATE
);

CREATE TABLE Categories_Depenses (
    ID_Categorie INT PRIMARY KEY,
    Nom_Categorie VARCHAR(255)
);

CREATE TABLE Configuration_Salaire (
    ID_Configuration INT PRIMARY KEY,
    Montant_Salaire_Kg DECIMAL(5,2)
);

CREATE TABLE Cueillettes (
    ID_Cueillette INT PRIMARY KEY,
    Date_Cueillette DATE,
    Poids_Cueilli DECIMAL(5,2),
    ID_Cueilleur INT,
    ID_Parcelle INT,
    FOREIGN KEY (ID_Cueilleur) REFERENCES Cueilleurs(ID_Cueilleur),
    FOREIGN KEY (ID_Parcelle) REFERENCES Parcelles(ID_Parcelle)
);

CREATE TABLE Depenses (
    ID_Depense INT PRIMARY KEY,
    Date_Depense DATE,
    Montant DECIMAL(10,2),
    ID_Categorie INT,
    FOREIGN KEY (ID_Categorie) REFERENCES Categories_Depenses(ID_Categorie)
);



/***************** INSERTION DE DONNEES ***************/

INSERT INTO Varietes_The (Nom_Variete, Occupation_Pied, Rendement_Pied_Mois) VALUES
('Thé Vert', 1.5, 10),
('Thé Noir', 2, 8),
('Oolong', 1.8, 12);

INSERT INTO Admins (ID_Admins,Username, MDP) VALUES
(1, "Borman", 0000);

-- Insertion de données de test dans Parcelles
INSERT INTO Parcelles (Numero_Parcelle, Surface_Hectare, ID_Variete) VALUES
('P1', 2.5, 2), 
('P2', 3.0, 3), 
('P3', 1.8, 4); 


