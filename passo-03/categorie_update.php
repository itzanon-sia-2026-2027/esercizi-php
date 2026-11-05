<?php
require_once 'connessione.php';

$id = $_POST['id'];
$nome = trim($_POST['nome']);

$stmt = $pdo->prepare("UPDATE categorie SET nome = ? WHERE id = ?");
$stmt->execute([$nome, $id]);

header("Location: categorie.php");
exit;
