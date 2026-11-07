<?php
require_once 'connessione.php';

$titolo = trim($_POST['titolo']);
$anno = $_POST['anno_pubblicazione'];
$categoria_id = $_POST['categoria_id'];

if ($titolo == '') {
    $_SESSION['messaggio'] = 'Il titolo è obbligatorio';
} else {
    try {
        $stmt = $pdo->prepare("INSERT INTO libri (titolo, anno_pubblicazione, categoria_id) VALUES (?, ?, ?)");
        $stmt->execute([$titolo, $anno, $categoria_id]);
        $_SESSION['messaggio'] = 'Libro aggiunto';
    } catch (PDOException $e) {
        $_SESSION['messaggio'] = 'Errore: ' . $e->getMessage();
    }
}

header("Location: libri.php");
exit;
