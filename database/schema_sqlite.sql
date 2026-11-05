-- Schema base per gli esercizi - versione SQLite
-- Viene eseguito automaticamente da config/db_config.php quando il file
-- database/esercizi.sqlite è vuoto. Per ripartire da zero basta cancellare
-- il file esercizi.sqlite.

CREATE TABLE IF NOT EXISTS studenti (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    cognome TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    data_nascita TEXT,
    citta TEXT,
    corso TEXT,
    creato_il TEXT DEFAULT CURRENT_TIMESTAMP,
    modificato_il TEXT DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS corsi (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    descrizione TEXT,
    durata_ore INTEGER,
    docente TEXT,
    creato_il TEXT DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS iscrizioni (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    studente_id INTEGER NOT NULL,
    corso_id INTEGER NOT NULL,
    data_iscrizione TEXT NOT NULL,
    voto REAL,
    stato TEXT DEFAULT 'attivo' CHECK (stato IN ('attivo', 'completato', 'ritirato')),
    FOREIGN KEY (studente_id) REFERENCES studenti(id) ON DELETE CASCADE,
    FOREIGN KEY (corso_id) REFERENCES corsi(id) ON DELETE CASCADE,
    UNIQUE (studente_id, corso_id)
);

INSERT INTO studenti (nome, cognome, email, data_nascita, citta, corso) VALUES
('Mario', 'Rossi', 'mario.rossi@email.com', '2000-05-15', 'Roma', 'Informatica'),
('Laura', 'Bianchi', 'laura.bianchi@email.com', '1999-08-22', 'Milano', 'Informatica'),
('Giuseppe', 'Verdi', 'giuseppe.verdi@email.com', '2001-03-10', 'Napoli', 'Ingegneria'),
('Sofia', 'Russo', 'sofia.russo@email.com', '2000-11-30', 'Torino', 'Informatica'),
('Alessandro', 'Ferrari', 'alessandro.ferrari@email.com', '1998-07-18', 'Firenze', 'Matematica');

INSERT INTO corsi (nome, descrizione, durata_ore, docente) VALUES
('PHP Base', 'Introduzione al linguaggio PHP', 40, 'Prof. Giovanni Neri'),
('Database MySQL', 'Fondamenti di database e SQL', 50, 'Prof. Maria Conti'),
('Sviluppo Web', 'HTML, CSS e JavaScript', 60, 'Prof. Luca Martini'),
('PHP Avanzato', 'Programmazione PHP avanzata', 45, 'Prof. Giovanni Neri');

INSERT INTO iscrizioni (studente_id, corso_id, data_iscrizione, voto, stato) VALUES
(1, 1, '2024-01-15', 28.50, 'completato'),
(1, 2, '2024-02-01', NULL, 'attivo'),
(2, 1, '2024-01-15', 30.00, 'completato'),
(2, 3, '2024-02-15', NULL, 'attivo'),
(3, 2, '2024-01-20', 25.00, 'completato'),
(4, 1, '2024-01-15', NULL, 'attivo'),
(5, 4, '2024-03-01', NULL, 'attivo');
