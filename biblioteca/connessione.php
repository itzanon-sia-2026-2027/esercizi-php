<?php
// Questo file si include in ogni pagina con: require_once 'connessione.php';
// Dopo l'include trovi pronte la variabile $pdo (connessione al database),
// la sessione e la variabile $messaggio per i feedback.

// Sceglie in automatico quale database agganciare
if (isset($_SERVER['HTTP_HOST']) && str_contains($_SERVER['HTTP_HOST'], 'altervista.org')) {
    // Siamo online su Altervista -> Carica SQLite
    require_once 'connessione.sqlite.php';
} else {
    // Siamo in locale -> scegli quale caricare tra mysql e sqlite:
    require_once 'connessione.sqlite.php';
    //oppure
    //require_once 'connessione.mysql.php';
}


//Questa parte è comune a tutte le pagine PHP


// Avviare la sessione
session_start();

// Legge il messaggio salvato dalla pagina precedente e lo cancella subito così da mostrarlo una volta sola
$messaggio = '';
if (isset($_SESSION['messaggio'])) {
    $messaggio = $_SESSION['messaggio'];
    unset($_SESSION['messaggio']);
}
?>
