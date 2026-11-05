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

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorie as $c) { ?>
                    <tr>
                        <td><?= $c['id'] ?></td>
                        <td><?= htmlspecialchars($c['nome']) ?></td>
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
