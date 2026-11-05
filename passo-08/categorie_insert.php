<?php
require_once 'connessione.php';

$nome = trim($_POST['nome']);

if ($nome == '') {
    $_SESSION['messaggio'] = 'Il nome è obbligatorio';
} else {
    try {
        $stmt = $pdo->prepare("INSERT INTO categorie (nome) VALUES (?)");
        $stmt->execute([$nome]);
        $_SESSION['messaggio'] = 'Categoria aggiunta';
    } catch (PDOException $e) {
        $_SESSION['messaggio'] = 'Errore: ' . $e->getMessage();
    }
}

header("Location: categorie.php");
exit;
