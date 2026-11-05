<?php
require_once 'connessione.php';

$id = $_POST['id'];
$nome = trim($_POST['nome']);
$cognome = trim($_POST['cognome']);

if ($nome == '' || $cognome == '') {
    $_SESSION['messaggio'] = 'Nome e cognome sono obbligatori';
} else {
    try {
        $stmt = $pdo->prepare("UPDATE autori SET nome = ?, cognome = ? WHERE id = ?");
        $stmt->execute([$nome, $cognome, $id]);
        $_SESSION['messaggio'] = 'Autore modificato';
    } catch (PDOException $e) {
        $_SESSION['messaggio'] = 'Errore: ' . $e->getMessage();
    }
}

header("Location: autori.php");
exit;
