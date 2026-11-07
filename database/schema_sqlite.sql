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

-- Dati inventati per esercitarsi con un catalogo più grande.
INSERT INTO autori (nome, cognome) VALUES
('Ada', 'Bianchi'),
('Luca', 'Verdi'),
('Marta', 'Neri'),
('Paolo', 'Gialli');

INSERT INTO libri (titolo, anno_pubblicazione, categoria_id) VALUES
('Viaggi immaginari 01', 2001, 1),
('Viaggi immaginari 02', 2002, 1),
('Viaggi immaginari 03', 2003, 1),
('Viaggi immaginari 04', 2004, 1),
('Viaggi immaginari 05', 2005, 1),
('Viaggi immaginari 06', 2006, 1),
('Viaggi immaginari 07', 2007, 1),
('Viaggi immaginari 08', 2008, 1),
('Viaggi immaginari 09', 2009, 1),
('Viaggi immaginari 10', 2010, 1),
('Viaggi immaginari 11', 2011, 1),
('Viaggi immaginari 12', 2012, 1),
('Viaggi immaginari 13', 2013, 1),
('Viaggi immaginari 14', 2014, 1),
('Viaggi immaginari 15', 2015, 1),
('Viaggi immaginari 16', 2016, 1),
('Viaggi immaginari 17', 2017, 1),
('Viaggi immaginari 18', 2018, 1),
('Viaggi immaginari 19', 2019, 1),
('Viaggi immaginari 20', 2020, 1),
('Viaggi immaginari 21', 2021, 1),
('Viaggi immaginari 22', 2022, 1),
('Viaggi immaginari 23', 2023, 1),
('Viaggi immaginari 24', 2024, 1),
('Misteri della città 01', 2011, 3),
('Misteri della città 02', 2012, 3),
('Misteri della città 03', 2013, 3),
('Misteri della città 04', 2014, 3),
('Misteri della città 05', 2015, 3),
('Misteri della città 06', 2016, 3),
('Misteri della città 07', 2017, 3),
('Misteri della città 08', 2018, 3),
('Stelle lontane 01', 2011, 2),
('Stelle lontane 02', 2012, 2),
('Stelle lontane 03', 2013, 2),
('Stelle lontane 04', 2014, 2),
('Stelle lontane 05', 2015, 2),
('Stelle lontane 06', 2016, 2),
('Stelle lontane 07', 2017, 2),
('Stelle lontane 08', 2018, 2),
('Appunti di lettura 01', 2011, 4),
('Appunti di lettura 02', 2012, 4),
('Appunti di lettura 03', 2013, 4),
('Appunti di lettura 04', 2014, 4),
('Appunti di lettura 05', 2015, 4),
('Appunti di lettura 06', 2016, 4),
('Appunti di lettura 07', 2017, 4),
('Appunti di lettura 08', 2018, 4);

INSERT INTO libro_autore (libro_id, autore_id, ruolo)
SELECT id, 5, 'Autore' FROM libri WHERE titolo LIKE 'Viaggi immaginari %';
INSERT INTO libro_autore (libro_id, autore_id, ruolo)
SELECT id, 6, 'Autore' FROM libri WHERE titolo LIKE 'Misteri della città %';
INSERT INTO libro_autore (libro_id, autore_id, ruolo)
SELECT id, 7, 'Autore' FROM libri WHERE titolo LIKE 'Stelle lontane %';
INSERT INTO libro_autore (libro_id, autore_id, ruolo)
SELECT id, 8, 'Autore' FROM libri WHERE titolo LIKE 'Appunti di lettura %';
