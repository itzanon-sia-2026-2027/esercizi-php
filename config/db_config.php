<?php
/**
 * ============================================================================
 * CONFIGURAZIONE DATABASE - Portale Biblioteca con PDO
 * ============================================================================
 *
 * Questo è l'UNICO file di configurazione del progetto.
 * Scegli il database con DB_DRIVER:
 *
 *   'sqlite' -> un semplice file (database/biblioteca.sqlite). NON serve
 *               installare nulla, funziona in locale e su Altervista e ogni
 *               studente ha il proprio database. Le tabelle e i dati di
 *               esempio vengono creati automaticamente al primo avvio.
 *
 *   'mysql'  -> server MySQL/MariaDB (XAMPP oppure Altervista).
 *               Importa prima database/schema.sql.
 *
 * Valori MySQL tipici:
 *   XAMPP:      DB_USER 'root',      DB_PASS '',             DB_NAME 'biblioteca'
 *   Altervista: DB_USER 'username',  DB_PASS 'tuapassword',  DB_NAME 'my_username'
 *
 * IMPORTANTE: se usi MySQL con la password reale di Altervista,
 * NON caricare questo file su repository pubblici.
 * ============================================================================
 */

// ===== SCEGLI IL DATABASE =====
define('DB_DRIVER', 'sqlite');          // 'sqlite' oppure 'mysql'

// ===== CONFIGURAZIONE SQLITE =====
define('SQLITE_FILE', __DIR__ . '/../database/biblioteca.sqlite');
define('SQLITE_SCHEMA', __DIR__ . '/../database/schema_sqlite.sql');

// ===== CONFIGURAZIONE MYSQL (usata solo se DB_DRIVER è 'mysql') =====
define('DB_HOST', 'localhost');
define('DB_USER', 'root');              // Altervista: il tuo username
define('DB_PASS', '');                  // Altervista: la tua password
define('DB_NAME', 'biblioteca');      // Altervista: my_username
define('DB_CHARSET', 'utf8mb4');

// ===== FUNZIONI DATABASE (NON MODIFICARE) =====

/**
 * Crea la connessione al database usando PDO
 *
 * In caso di errore lancia una PDOException: gestiscila con try/catch.
 *
 * @return PDO Oggetto di connessione
 */
function connetti_database() {
    $opzioni = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    if (DB_DRIVER === 'sqlite') {
        // Il file viene creato automaticamente se non esiste
        $pdo = new PDO('sqlite:' . SQLITE_FILE, null, null, $opzioni);
        $pdo->exec('PRAGMA foreign_keys = ON');
        inizializza_sqlite($pdo);
    } else {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $opzioni);
    }

    return $pdo;
}

/**
 * Se il database SQLite è vuoto, crea le tabelle e inserisce i dati di esempio
 *
 * @param PDO $pdo Connessione SQLite
 * @return void
 */
function inizializza_sqlite($pdo) {
    $tabella = $pdo->query("SELECT name FROM sqlite_master WHERE type = 'table' AND name = 'categorie'")->fetch();

    if (!$tabella) {
        $pdo->exec(file_get_contents(SQLITE_SCHEMA));
    }
}

/**
 * Chiude la connessione al database
 *
 * In PDO la connessione si chiude assegnando null alla variabile.
 *
 * @param PDO $pdo Connessione da chiudere
 * @return void
 */
function chiudi_database(&$pdo) {
    $pdo = null;
}
?>
