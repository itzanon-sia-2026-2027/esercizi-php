-- Portale Biblioteca - versione MySQL (XAMPP / Altervista)
-- Su XAMPP: importa questo file da phpMyAdmin.
-- Su Altervista: il database esiste gia', quindi importa SOLO le istruzioni
-- da "CREATE TABLE" in poi (togli le prime due istruzioni).

CREATE DATABASE IF NOT EXISTS biblioteca CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE biblioteca;

CREATE TABLE categorie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE libri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titolo VARCHAR(150) NOT NULL,
    anno_pubblicazione INT,
    categoria_id INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorie(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE autori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    cognome VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

-- Tabella ponte: relazione N:M tra libri e autori
CREATE TABLE libro_autore (
    libro_id INT NOT NULL,
    autore_id INT NOT NULL,
    ruolo VARCHAR(50) NOT NULL,
    PRIMARY KEY (libro_id, autore_id),
    FOREIGN KEY (libro_id) REFERENCES libri(id) ON DELETE CASCADE,
    FOREIGN KEY (autore_id) REFERENCES autori(id) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO categorie (nome) VALUES
('Romanzo'),
('Fantascienza'),
('Giallo'),
('Saggio');

INSERT INTO libri (titolo, anno_pubblicazione, categoria_id) VALUES
('Il nome della rosa', 1980, 3),
('Dune', 1965, 2),
('Il buon inizio', 2010, 4),
('Buona apocalisse a tutti', 2020, 1);

INSERT INTO autori (nome, cognome) VALUES
('Umberto', 'Eco'),
('Frank', 'Herbert'),
('Isaac', 'Asimov'),
('Michele', 'Rossi');

INSERT INTO libro_autore (libro_id, autore_id, ruolo) VALUES
(1, 1, 'Autore'),
(2, 2, 'Autore'),
(2, 3, 'Prefazione'),
(3, 4, 'Autore'),
(4, 4, 'Curatore');
