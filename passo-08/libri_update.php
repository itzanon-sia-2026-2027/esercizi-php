<?php
require_once 'connessione.php';

$id = $_POST['id'];
$titolo = trim($_POST['titolo']);
$anno = $_POST['anno_pubblicazione'];
$categoria_id = $_POST['categoria_id'];

if ($titolo == '') {
    $_SESSION['messaggio'] = 'Il titolo è obbligatorio';
} else {
    try {
        $stmt = $pdo->prepare("UPDATE libri SET titolo = ?, anno_pubblicazione = ?, categoria_id = ? WHERE id = ?");
        $stmt->execute([$titolo, $anno, $categoria_id, $id]);
        $_SESSION['messaggio'] = 'Libro modificato';
    } catch (PDOException $e) {
        $_SESSION['messaggio'] = 'Errore: ' . $e->getMessage();
    }
}

header("Location: libri.php");
exit;
