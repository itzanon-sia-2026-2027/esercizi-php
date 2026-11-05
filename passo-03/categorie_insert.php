<?php
require_once 'connessione.php';

$nome = trim($_POST['nome']);

$stmt = $pdo->prepare("INSERT INTO categorie (nome) VALUES (?)");
$stmt->execute([$nome]);

header("Location: categorie.php");
exit;
