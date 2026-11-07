<?php
require_once 'connessione.php';

$titolo = '';
$errore = '';
$libri = [];
$altri_risultati = false;

if (isset($_GET['titolo'])) {
    if (!is_string($_GET['titolo'])) {
        $errore = 'Inserisci un titolo valido.';
    } else {
        $titolo = trim($_GET['titolo']);
        if ($titolo === '') {
            $errore = 'Inserisci almeno una parte del titolo.';
        }
    }

    if ($errore === '') {
        $termine = str_replace(['!', '%', '_'], ['!!', '!%', '!_'], $titolo);
        $sql = "SELECT libri.id, libri.titolo, libri.anno_pubblicazione,
                       categorie.nome AS categoria
                FROM libri
                INNER JOIN categorie ON libri.categoria_id = categorie.id
                WHERE libri.titolo LIKE ? ESCAPE '!'
                ORDER BY libri.titolo, libri.id
                LIMIT 21";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['%' . $termine . '%']);
        $libri = $stmt->fetchAll();
        if (count($libri) > 20) {
            array_pop($libri);
            $altri_risultati = true;
        }
    }
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
    <?php } elseif (!isset($_GET['titolo'])) { ?>
        <p class="catalogo-messaggio">Inserisci una parte del titolo per cercare.</p>
    <?php } elseif (count($libri) === 0) { ?>
        <p class="catalogo-messaggio">Nessun libro trovato.</p>
    <?php } elseif ($altri_risultati) { ?>
        <p class="catalogo-messaggio">Sono mostrati i primi 20 risultati. Specifica meglio il titolo per cercare altri libri.</p>
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
