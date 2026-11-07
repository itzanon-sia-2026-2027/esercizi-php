<?php
// Configurazione MySQL (XAMPP in locale)
$host = 'localhost';
$db   = 'biblioteca'; // Cambia con il nome del DB dei ragazzi
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Mostra gli errori SQL
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC        // Array associativi di default
    ]);
} catch (PDOException $e) {
    die('Errore di connessione MySQL: ' . $e->getMessage());
}
?>
