<?php
require_once 'connessione.php';

$categorie = $pdo->query("SELECT id, nome FROM categorie ORDER BY nome")->fetchAll();
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Categorie</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/crud.css">
</head>

<body>
    <header>
        <h1>🏷️ Gestione Categorie</h1>
        <p><a href="index.php">⬅️ Home</a></p>
    </header>

    <main>
        <form action="categorie_insert.php" method="post">
            <h2>Nuova categoria</h2>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" required>
            <button type="submit">Aggiungi</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorie as $c) { ?>
                    <tr>
                        <td><?= $c['id'] ?></td>
                        <td><?= htmlspecialchars($c['nome']) ?></td>
                        <td>
                            <a href="categorie_edit.php?id=<?= $c['id'] ?>">Modifica</a>
                            <a href="categorie_delete.php?id=<?= $c['id'] ?>" onclick="return confirm('Cancellare la categoria?');">Elimina</a>
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
