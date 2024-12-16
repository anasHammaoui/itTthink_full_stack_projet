CREATE DATABASE itThink;
USE itThink;
CREATE TABLE Utilisateurs (
	id_utilisateur INT PRIMARY KEY,
	nom_utilisateur VARCHAR(50),
	mot_de_passe VARCHAR(50),
	email VARCHAR(50)
);

INSERT INTO utilisateurs
VALUES (999,"Ahmed","Ahmed111@","ahmed@gmail.co");

CREATE TABLE categorie(
	id_categorie INT PRIMARY KEY,
	nom_categorie VARCHAR(50)
);
INSERT INTO categorie
VALUES (888,"coding");

CREATE TABLE sous_categorie(
	id_sous_categorie INT PRIMARY KEY,
	nom_sous_categorie VARCHAR(50),
	id_categorie INT,
	FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie)
);

INSERT INTO sous_categorie (id_sous_categorie,nom_sous_categorie,id_categorie)
VALUES (666,"landing pages",888);

UPDATE sous_categorie
SET id_categorie = 888
WHERE id_sous_categorie = 666;

CREATE TABLE projets(
	id_projet INT PRIMARY KEY,
	titre_projet VARCHAR(50),
	projet_description VARCHAR(500),
	id_categorie INT,
	id_sous_categorie INT,
	id_utilisateur INT,
	FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie),
	FOREIGN KEY (id_sous_categorie) REFERENCES sous_categorie(id_sous_categorie),
	FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);
CREATE TABLE freelances(
	id_freelance INT PRIMARY KEY,
	nom_freelance VARCHAR(50),
	competences VARCHAR(50),
	id_utilisateur INT,
	FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);
INSERT INTO freelances
VALUES (121,"anas","full stack developer",999);
CREATE TABLE offres(
	id_offre INT PRIMARY KEY,
	montant INT,
	delai DATE,
	id_freelance INT,
	id_projet INT,
	FOREIGN KEY (id_freelance) REFERENCES freelances(id_freelance),
	FOREIGN KEY (id_projet) REFERENCES projets(id_projet)
);
CREATE TABLE testimonials(
	id_temoignage INT,
	commentaire VARCHAR(500),
	id_utilisateur INT,
	FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur)
);
ALTER TABLE projets
ADD date_creation DATE;

SELECT * FROM projets;

ALTER TABLE projets
RENAME COLUMN date_creation TO created_in;

INSERT INTO offres (id_offre,montant,delai)
VALUES (1078,78, '2024-12-29');

UPDATE offres
SET id_freelance = 121, id_projet = 123
WHERE id_offre = 1078;


INSERT INTO projets (id_projet,titre_projet,projet_description,id_categorie,id_sous_categorie,id_utilisateur,created_in)
VALUES (123,"landing page","the best lannding page that ever made, is made by codziac",888,666,999, "2024-12-07");

SELECT * FROM projets;

UPDATE projets SET titre_projet = "changed", projet_description = "desc changed" WHERE id_projet = 123;

INSERT INTO testimonials (id_temoignage, commentaire)
VALUES (111,"you're the best")

DELETE FROM testimonials WHERE id_temoignage = 111;

SELECT sous_categorie.nom_sous_categorie, sous_categorie.id_sous_categorie, categorie.nom_categorie, categorie.id_categorie
FROM sous_categorie
INNER JOIN categorie
ON sous_categorie.id_categorie = categorie.id_categorie;

SELECT * FROM utilisateurs;
SELECT * FROM categorie;
SELECT * FROM sous_categorie;
SELECT * FROM projets;
SELECT * FROM freelances;
SELECT * FROM offres;
