<?php
require_once 'connessione.php';

$id = $_GET['id'];

try {
    // Gli autori collegati (libro_autore) si cancellano da soli: ON DELETE CASCADE
    $stmt = $pdo->prepare("DELETE FROM libri WHERE id = ?");
    $stmt->execute([$id]);
    $_SESSION['messaggio'] = 'Libro eliminato';
} catch (PDOException $e) {
    $_SESSION['messaggio'] = 'Errore: ' . $e->getMessage();
}

header("Location: libri.php");
exit;
