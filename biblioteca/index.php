<?php
require_once 'connessione.php';

$titolo = $_GET['titolo'] ?? '';
$errore = '';
$libri = [];
$totale_risultati = 0; // Sostituito il flag booleano con un contatore esplicito
$altri_risultati = false;

if (!empty($titolo)) {
    // 1. PRIMA QUERY: Conta quanti libri totali corrispondono alla ricerca
    $sql_count = "SELECT COUNT(*) AS totale FROM libri WHERE titolo LIKE ?";
    $stmt_count = $pdo->prepare($sql_count);
    $stmt_count->execute(['%' . $titolo . '%']);
    
    // Fetch standard della singola riga (come hanno sempre fatto)
    $riga_count = $stmt_count->fetch();
    $totale_risultati = $riga_count['totale']; 

    // Logica immediata e leggibile
    $altri_risultati = ($totale_risultati > 20);

    // 2. SECONDA QUERY: Prende esattamente i 20 record da mostrare
    $sql = "SELECT libri.id, libri.titolo, libri.anno_pubblicazione,
                       categorie.nome AS categoria
                FROM libri
                INNER JOIN categorie ON libri.categoria_id = categorie.id
                WHERE libri.titolo LIKE ?
                ORDER BY libri.titolo, libri.id
                LIMIT 20"; // Limit preciso a 20, senza trucchi
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['%' . $titolo . '%']);
    $libri = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>📚 Biblioteca</h1>
        <p>Catalogo dei libri</p>
        <p>
            <a href="categorie.php">⚙️ Gestisci Categorie</a>
            <a href="libri.php">⚙️ Gestisci Libri</a>
            <a href="autori.php">⚙️ Gestisci Autori</a>
            <a href="statistiche.php">📊 Statistiche Catalogo</a>
            <a href="catalogo_ajax.php">⚡ Catalogo senza ricaricare (fetch)</a>
        </p>
    </header>

    <form class="catalogo-ricerca" action="index.php" method="get">
        <label for="titolo">Cerca nel titolo</label>
        <input id="titolo" name="titolo" type="search" required
            value="<?= htmlspecialchars($titolo) ?>">
        <button type="submit">Cerca</button>
    </form>
    
    <?php if ($errore !== '') { ?>
        <p class="catalogo-messaggio" role="alert"><?= htmlspecialchars($errore) ?></p>
    <?php } elseif (empty($titolo)) { ?>
        <p class="catalogo-messaggio">Inserisci una parte del titolo per cercare.</p>
    <?php } elseif (count($libri) === 0) { ?>
        <p class="catalogo-messaggio">Nessun libro trovato.</p>
    <?php } elseif ($altri_risultati) { ?>
        <!-- Nota didattica: ora possiamo anche dire quanti ne sono stati trovati in totale! -->
        <p class="catalogo-messaggio">Trovati <?= $totale_risultati ?> risultati. Sono mostrati solo i primi 20. Specifica meglio il titolo per affinare la ricerca.</p>
    <?php } ?>

    <main>
        <?php foreach ($libri as $l) {
            // Per ogni libro cerco i suoi autori passando dalla tabella ponte
            $sql = "SELECT autori.nome, autori.cognome, libro_autore.ruolo
                    FROM autori
                    INNER JOIN libro_autore ON autori.id = libro_autore.autore_id
                    WHERE libro_autore.libro_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$l['id']]);
            $autori = $stmt->fetchAll(); ?>
            <article>
                <div>
                    <span><?= htmlspecialchars($l['categoria']) ?></span>
                    <h2><?= htmlspecialchars($l['titolo']) ?></h2>
                    <a href="libri_edit.php?id=<?= $l['id'] ?>">Modifica libro</a>
                    <time datetime="<?= $l['anno_pubblicazione'] ?>"><?= $l['anno_pubblicazione'] ?></time>

                    <h3>Autori</h3>
                    <ul>
                        <?php foreach ($autori as $a) { ?>
                            <li>
                                <div>
                                    <strong><?= htmlspecialchars($a['nome'] . ' ' . $a['cognome']) ?></strong>
                                    <span><?= htmlspecialchars($a['ruolo']) ?></span>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </article>
        <?php } ?>
    </main>

    <footer>
        <p>&copy; 2026 5B SIA</p>
    </footer>
</body>

</html>
