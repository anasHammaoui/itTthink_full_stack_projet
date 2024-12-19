CREATE DATABASE itThink;
USE itThink;

CREATE TABLE Utilisateurs (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom_utilisateur VARCHAR(50),
    mot_de_passe TEXT,
    email VARCHAR(50)
);

ALTER TABLE Utilisateurs
ADD user_role VARCHAR(100);

CREATE TABLE categorie (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(50)
);


CREATE TABLE sous_categorie (
    id_sous_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_sous_categorie VARCHAR(50),
    id_categorie INT,
    FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie)
);


CREATE TABLE projets (
    id_projet INT AUTO_INCREMENT PRIMARY KEY,
    titre_projet VARCHAR(50),
    projet_description VARCHAR(500),
    id_categorie INT,
    id_sous_categorie INT,
    id_utilisateur INT,
    created_in DATE,
    FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie),
    FOREIGN KEY (id_sous_categorie) REFERENCES sous_categorie(id_sous_categorie),
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);

CREATE TABLE freelances (
    id_freelance INT AUTO_INCREMENT PRIMARY KEY,
    nom_freelance VARCHAR(50),
    competences VARCHAR(50),
    id_utilisateur INT,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);


CREATE TABLE offres (
    id_offre INT AUTO_INCREMENT PRIMARY KEY,
    montant INT,
    delai DATE,
    id_freelance INT,
    id_projet INT,
    FOREIGN KEY (id_freelance) REFERENCES freelances(id_freelance),
    FOREIGN KEY (id_projet) REFERENCES projets(id_projet)
);

CREATE TABLE testimonials (
    id_temoignage INT AUTO_INCREMENT PRIMARY KEY,
    commentaire VARCHAR(500),
    id_utilisateur INT,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);

SELECT * FROM Utilisateurs;
SELECT * FROM categorie;
SELECT * FROM sous_categorie;
SELECT * FROM projets;
SELECT * FROM freelances;
SELECT * FROM offres;
CREATE DATABASE itThink;
USE itThink;

CREATE TABLE Utilisateurs (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom_utilisateur VARCHAR(50),
    mot_de_passe TEXT,
    email VARCHAR(50)
);

CREATE TABLE categorie (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(50)
);

CREATE TABLE sous_categorie (
    id_sous_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_sous_categorie VARCHAR(50),
    id_categorie INT,
    FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie)
);


CREATE TABLE projets (
    id_projet INT AUTO_INCREMENT PRIMARY KEY,
    titre_projet VARCHAR(50),
    projet_description VARCHAR(500),
    id_categorie INT,
    id_sous_categorie INT,
    id_utilisateur INT,
    created_in DATE,
    FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie),
    FOREIGN KEY (id_sous_categorie) REFERENCES sous_categorie(id_sous_categorie),
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);

CREATE TABLE freelances (
    id_freelance INT AUTO_INCREMENT PRIMARY KEY,
    nom_freelance VARCHAR(50),
    competences VARCHAR(50),
    id_utilisateur INT,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);


CREATE TABLE offres (
    id_offre INT AUTO_INCREMENT PRIMARY KEY,
    montant INT,
    delai DATE,
    id_freelance INT,
    id_projet INT,
    FOREIGN KEY (id_freelance) REFERENCES freelances(id_freelance),
    FOREIGN KEY (id_projet) REFERENCES projets(id_projet)
);

CREATE TABLE testimonials (
    id_temoignage INT AUTO_INCREMENT PRIMARY KEY,
    commentaire VARCHAR(500),
    id_utilisateur INT,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);

INSERT INTO offres (montant, delai, id_freelance, id_projet)
VALUES (78, '2024-12-29', 1, 1);


ALTER TABLE utilisateurs AUTO_INCREMENT=0;
SELECT * FROM Utilisateurs;
SELECT * FROM categorie;
SELECT * FROM sous_categorie;
SELECT * FROM projets;
SELECT * FROM freelances;
SELECT * FROM offres;
