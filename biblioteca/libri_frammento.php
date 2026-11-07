<?php
// Questa pagina NON restituisce una pagina intera ma solo un pezzo di HTML
// (un frammento). Lo richiama il JavaScript con fetch.
require_once 'connessione.php';

$categoria_id = $_GET['categoria_id'];

$sql = "SELECT libri.id, libri.titolo, libri.anno_pubblicazione
        FROM libri
        WHERE libri.categoria_id = ?
        ORDER BY libri.titolo";
$stmt = $pdo->prepare($sql);
$stmt->execute([$categoria_id]);
$libri = $stmt->fetchAll();

if (count($libri) == 0) {
    echo "<p>Nessun libro in questa categoria.</p>";
}

foreach ($libri as $l) { ?>
    <tr>
        <td>
            <h2><?= htmlspecialchars($l['titolo']) ?> (<?= $l['anno_pubblicazione'] ?>)</h2>
        </td>
        <td>
            <button onclick="carica_autori(<?= $l['id'] ?>, event)">Mostra autori</button>
            <ul id="autori_<?= $l['id'] ?>"></ul>
        </td>
    </tr>
<?php }
