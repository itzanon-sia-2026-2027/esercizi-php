<?php
require_once 'connessione.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT id, titolo, anno_pubblicazione, categoria_id FROM libri WHERE id = ?");
$stmt->execute([$id]);
$libro = $stmt->fetch();

if (!$libro) {
    $_SESSION['messaggio'] = 'Libro non trovato';
    header("Location: libri.php");
    exit;
}

$categorie = $pdo->query("SELECT id, nome FROM categorie ORDER BY nome")->fetchAll();
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Libro</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/crud.css">
</head>

<body>
    <header>
        <h1>✏️ Modifica Libro</h1>
        <p><a href="libri.php">⬅️ Torna ai libri</a></p>
    </header>

    <main>
        <form action="libri_update.php" method="post">
            <input type="hidden" name="id" value="<?= $libro['id'] ?>">
            <label for="titolo">Titolo</label>
            <input type="text" name="titolo" id="titolo" value="<?= htmlspecialchars($libro['titolo']) ?>" required>
            <label for="anno_pubblicazione">Anno di pubblicazione</label>
            <input type="number" name="anno_pubblicazione" id="anno_pubblicazione" value="<?= $libro['anno_pubblicazione'] ?>" required>
            <label for="categoria_id">Categoria</label>
            <select name="categoria_id" id="categoria_id" required>
                <?php foreach ($categorie as $c) { ?>
                    <option value="<?= $c['id'] ?>" <?php if ($c['id'] == $libro['categoria_id']) { echo 'selected'; } ?>>
                        <?= htmlspecialchars($c['nome']) ?>
                    </option>
                <?php } ?>
            </select>
            <button type="submit">Salva</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2026 5B SIA</p>
    </footer>
</body>

</html>
