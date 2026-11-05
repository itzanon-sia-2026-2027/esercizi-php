<?php
require_once 'connessione.php';

$id = $_GET['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM categorie WHERE id = ?");
    $stmt->execute([$id]);
    $_SESSION['messaggio'] = 'Categoria eliminata';
} catch (PDOException $e) {
    // Succede se ci sono libri in questa categoria (ON DELETE RESTRICT)
    $_SESSION['messaggio'] = 'Impossibile eliminare: ci sono libri collegati a questa categoria';
}

header("Location: categorie.php");
exit;
