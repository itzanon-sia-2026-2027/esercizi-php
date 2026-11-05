-- Portale Biblioteca - versione SQLite
-- Viene eseguito automaticamente da config/db_config.php quando il file
-- database/biblioteca.sqlite e' vuoto. Per ripartire da zero basta cancellare
-- il file biblioteca.sqlite.

CREATE TABLE categorie (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL UNIQUE
);

CREATE TABLE libri (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    titolo TEXT NOT NULL,
    anno_pubblicazione INTEGER,
    categoria_id INTEGER NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorie(id) ON DELETE RESTRICT
);

CREATE TABLE autori (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    cognome TEXT NOT NULL
);

-- Tabella ponte: relazione N:M tra libri e autori
CREATE TABLE libro_autore (
    libro_id INTEGER NOT NULL,
    autore_id INTEGER NOT NULL,
    ruolo TEXT NOT NULL,
    PRIMARY KEY (libro_id, autore_id),
    FOREIGN KEY (libro_id) REFERENCES libri(id) ON DELETE CASCADE,
    FOREIGN KEY (autore_id) REFERENCES autori(id) ON DELETE CASCADE
);

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
