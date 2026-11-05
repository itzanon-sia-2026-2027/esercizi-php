<?php
// Questo file si include in ogni pagina con: require_once 'connessione.php';
// Dopo l'include trovi pronte la variabile $pdo (connessione al database)
// e la sessione (serve per passare i messaggi da una pagina all'altra).
require_once '../config/db_config.php';

session_start();

try {
    $pdo = connetti_database();
} catch (PDOException $e) {
    die('Errore di connessione: ' . $e->getMessage());
}

// Legge il messaggio salvato dalla pagina precedente e lo cancella
$messaggio = '';
if (isset($_SESSION['messaggio'])) {
    $messaggio = $_SESSION['messaggio'];
    unset($_SESSION['messaggio']);
}
?>
