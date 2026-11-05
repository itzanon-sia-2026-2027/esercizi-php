<?php
require_once 'connessione.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM categorie WHERE id = ?");
$stmt->execute([$id]);

header("Location: categorie.php");
exit;
