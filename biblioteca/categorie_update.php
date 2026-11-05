<?php
require_once 'connessione.php';

$id = $_POST['id'];
$nome = trim($_POST['nome']);

if ($nome == '') {
    $_SESSION['messaggio'] = 'Il nome è obbligatorio';
} else {
    try {
        $stmt = $pdo->prepare("UPDATE categorie SET nome = ? WHERE id = ?");
        $stmt->execute([$nome, $id]);
        $_SESSION['messaggio'] = 'Categoria modificata';
    } catch (PDOException $e) {
        $_SESSION['messaggio'] = 'Errore: ' . $e->getMessage();
    }
}

header("Location: categorie.php");
exit;
