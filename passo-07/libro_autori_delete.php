<?php
require_once 'connessione.php';

$libro_id = $_GET['libro_id'];
$autore_id = $_GET['autore_id'];

try {
    $stmt = $pdo->prepare("DELETE FROM libro_autore WHERE libro_id = ? AND autore_id = ?");
    $stmt->execute([$libro_id, $autore_id]);
    $_SESSION['messaggio'] = 'Autore scollegato';
} catch (PDOException $e) {
    $_SESSION['messaggio'] = 'Errore: ' . $e->getMessage();
}

header("Location: libro_autori.php?id=" . $libro_id);
exit;
