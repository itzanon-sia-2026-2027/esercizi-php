<?php
require_once 'connessione.php';

$sql = "SELECT libri.id,
               libri.titolo,
               libri.anno_pubblicazione,
               categorie.nome AS categoria
        FROM libri
        INNER JOIN categorie ON libri.categoria_id = categorie.id
        ORDER BY libri.titolo";
$libri = $pdo->query($sql)->fetchAll();

// Serve per riempire il menu a tendina del form
$categorie = $pdo->query("SELECT id, nome FROM categorie ORDER BY nome")->fetchAll();
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Libri</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/crud.css">
</head>

<body>
    <header>
        <h1>📚 Gestione Libri</h1>
        <p><a href="index.php">⬅️ Home</a></p>
    </header>

    <main>
        <?php if ($messaggio != '') { ?>
            <p><?= htmlspecialchars($messaggio) ?></p>
        <?php } ?>

        <form action="libri_insert.php" method="post">
            <h2>Nuovo libro</h2>
            <label for="titolo">Titolo</label>
            <input type="text" name="titolo" id="titolo" required>
            <label for="anno_pubblicazione">Anno di pubblicazione</label>
            <input type="number" name="anno_pubblicazione" id="anno_pubblicazione" required>
            <label for="categoria_id">Categoria</label>
            <select name="categoria_id" id="categoria_id" required>
                <?php foreach ($categorie as $c) { ?>
                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
                <?php } ?>
            </select>
            <button type="submit">Aggiungi</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titolo</th>
                    <th>Anno</th>
                    <th>Categoria</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($libri as $l) { ?>
                    <tr>
                        <td><?= $l['id'] ?></td>
                        <td><?= htmlspecialchars($l['titolo']) ?></td>
                        <td><?= $l['anno_pubblicazione'] ?></td>
                        <td><?= htmlspecialchars($l['categoria']) ?></td>
                        <td>
                            <a href="libri_edit.php?id=<?= $l['id'] ?>">Modifica</a>
                            <a href="libri_delete.php?id=<?= $l['id'] ?>" onclick="return confirm('Cancellare il libro?');">Elimina</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; 2026 5B SIA</p>
    </footer>
</body>

</html>
