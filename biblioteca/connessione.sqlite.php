<?php
// Configurazione SQLite
$sqlite_file   = __DIR__ . '/../database/biblioteca.sqlite';
$sqlite_schema = __DIR__ . '/../database/schema_sqlite.sql';

try {
    // Connessione a SQLite (crea il file se non esiste)
    $pdo = new PDO('sqlite:' . $sqlite_file, null, null, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // Forza SQLite a rispettare le chiavi esterne (Foreign Keys)
    $pdo->exec('PRAGMA foreign_keys = ON');

    // CONTROLLO AUTOMATICO TABELLE:
    // Se la tabella 'categorie' non esiste, popola il database usando il file .sql
    $tabella = $pdo->query("SELECT name FROM sqlite_master WHERE type = 'table' AND name = 'categorie'")->fetch();

    if (!$tabella) {
        $sql = file_get_contents($sqlite_schema);
        $pdo->exec($sql);
    }

} catch (PDOException $e) {
    die('Errore di connessione SQLite: ' . $e->getMessage());
}
?>
