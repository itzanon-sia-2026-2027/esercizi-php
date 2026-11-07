<?php
// Questo file si include in ogni pagina con: require_once 'connessione.php';
// Dopo l'include trovi pronte la variabile $pdo (connessione al database)
// e la sessione (serve per passare i messaggi da una pagina all'altra).

session_start();


// Legge il messaggio salvato dalla pagina precedente e lo cancella
$messaggio = '';
if (isset($_SESSION['messaggio'])) {
    $messaggio = $_SESSION['messaggio'];
    unset($_SESSION['messaggio']);
}


//****************************************************************************
//VERSIONE MYSQL
// Configurazione MySQL (XAMPP in locale)
$host = 'localhost';
$db   = 'biblioteca'; // Il nome del database che useranno su XAMPP
$user = 'root';
$pass = '';

try {
    // Creazione dell'oggetto PDO lineare
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Mostra gli errori SQL come eccezioni
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC        // fetch() restituisce array associativi
    ]);
} catch (PDOException $e) {
    die('Errore di connessione: ' . $e->getMessage());
}
//****************************************************************************



?>
