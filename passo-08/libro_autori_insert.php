<?php
require_once 'connessione.php';

$libro_id = $_POST['libro_id'];
$autore_id = $_POST['autore_id'];
$ruolo = trim($_POST['ruolo']);

if ($ruolo == '') {
    $_SESSION['messaggio'] = 'Il ruolo è obbligatorio';
} else {
    try {
        $stmt = $pdo->prepare("INSERT INTO libro_autore (libro_id, autore_id, ruolo) VALUES (?, ?, ?)");
        $stmt->execute([$libro_id, $autore_id, $ruolo]);
        $_SESSION['messaggio'] = 'Autore collegato';
    } catch (PDOException $e) {
        $_SESSION['messaggio'] = 'Errore: ' . $e->getMessage();
    }
}

header("Location: libro_autori.php?id=" . $libro_id);
exit;
