<?php
require_once 'connessione.php';

$autori = $pdo->query("SELECT id, nome, cognome FROM autori ORDER BY cognome, nome")->fetchAll();
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Autori</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/crud.css">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
</head>

<body>
    <header>
        <h1>✍️ Gestione Autori</h1>
        <p><a href="index.php">⬅️ Home</a></p>
    </header>

    <main>
        <?php if ($messaggio != '') { ?>
            <p><?= htmlspecialchars($messaggio) ?></p>
        <?php } ?>

        <form action="autori_insert.php" method="post">
            <h2>Nuovo autore</h2>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" required>
            <label for="cognome">Cognome</label>
            <input type="text" name="cognome" id="cognome" required>
            <button type="submit">Aggiungi</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($autori as $a) { ?>
                    <tr>
                        <td><?= $a['id'] ?></td>
                        <td><?= htmlspecialchars($a['nome']) ?></td>
                        <td><?= htmlspecialchars($a['cognome']) ?></td>
                        <td>
                            <a href="autori_edit.php?id=<?= $a['id'] ?>">Modifica</a>
                            <a href="autori_delete.php?id=<?= $a['id'] ?>" onclick="return confirm('Cancellare l\'autore?');">Elimina</a>
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
