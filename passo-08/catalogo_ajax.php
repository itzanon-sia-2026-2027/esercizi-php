<?php
require_once 'connessione.php';

$categorie = $pdo->query("SELECT id, nome FROM categorie ORDER BY nome")->fetchAll();
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo con fetch</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/crud.css">
    <script src="js/catalogo.js"></script>
</head>

<body>
    <header>
        <h1>⚡ Catalogo senza ricaricare la pagina</h1>
        <p><a href="index.php">⬅️ Home</a></p>
    </header>

    <main>
        <p>Clicca una categoria: la pagina NON si ricarica.</p>

        <?php foreach ($categorie as $c) { ?>
            <button onclick="carica_libri(<?= $c['id'] ?>)"><?= htmlspecialchars($c['nome']) ?></button>
        <?php } ?>

        <div id="elenco_libri"></div>
    </main>

    <footer>
        <p>&copy; 2026 5B SIA</p>
    </footer>
</body>

</html>
