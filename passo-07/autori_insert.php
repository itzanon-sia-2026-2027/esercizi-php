<?php
require_once 'connessione.php';

$nome = trim($_POST['nome']);
$cognome = trim($_POST['cognome']);

if ($nome == '' || $cognome == '') {
    $_SESSION['messaggio'] = 'Nome e cognome sono obbligatori';
} else {
    try {
        $stmt = $pdo->prepare("INSERT INTO autori (nome, cognome) VALUES (?, ?)");
        $stmt->execute([$nome, $cognome]);
        $_SESSION['messaggio'] = 'Autore aggiunto';
    } catch (PDOException $e) {
        $_SESSION['messaggio'] = 'Errore: ' . $e->getMessage();
    }
}

header("Location: autori.php");
exit;
