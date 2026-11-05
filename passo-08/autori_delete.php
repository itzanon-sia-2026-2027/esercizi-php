<?php
require_once 'connessione.php';

$id = $_GET['id'];

try {
    // I collegamenti con i libri (libro_autore) si cancellano da soli: ON DELETE CASCADE
    $stmt = $pdo->prepare("DELETE FROM autori WHERE id = ?");
    $stmt->execute([$id]);
    $_SESSION['messaggio'] = 'Autore eliminato';
} catch (PDOException $e) {
    $_SESSION['messaggio'] = 'Errore: ' . $e->getMessage();
}

header("Location: autori.php");
exit;
