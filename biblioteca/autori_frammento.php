<?php
// Restituisce solo l'elenco <ul> degli autori di un libro
require_once 'connessione.php';

$libro_id = $_GET['libro_id'];

$sql = "SELECT autori.nome, autori.cognome, libro_autore.ruolo
        FROM autori
        INNER JOIN libro_autore ON autori.id = libro_autore.autore_id
        WHERE libro_autore.libro_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$libro_id]);
$autori = $stmt->fetchAll();
?>
<ul>
    <?php foreach ($autori as $a) { ?>
        <li><?= htmlspecialchars($a['nome'] . ' ' . $a['cognome']) ?> - <?= htmlspecialchars($a['ruolo']) ?></li>
    <?php } ?>
</ul>
