<?php
require_once 'connessione.php';

$libro_id = $_GET['id'];

$stmt = $pdo->prepare("SELECT id, titolo FROM libri WHERE id = ?");
$stmt->execute([$libro_id]);
$libro = $stmt->fetch();

if (!$libro) {
    $_SESSION['messaggio'] = 'Libro non trovato';
    header("Location: libri.php");
    exit;
}

// Autori già collegati a questo libro (JOIN con la tabella ponte)
$sql = "SELECT autori.id, autori.nome, autori.cognome, libro_autore.ruolo
        FROM autori
        INNER JOIN libro_autore ON autori.id = libro_autore.autore_id
        WHERE libro_autore.libro_id = ?
        ORDER BY autori.cognome";
$stmt = $pdo->prepare($sql);
$stmt->execute([$libro_id]);
$autori_libro = $stmt->fetchAll();

// Autori ancora NON collegati: sono quelli che si possono aggiungere
$sql = "SELECT id, nome, cognome
        FROM autori
        WHERE id NOT IN (SELECT autore_id FROM libro_autore WHERE libro_id = ?)
        ORDER BY cognome";
$stmt = $pdo->prepare($sql);
$stmt->execute([$libro_id]);
$autori_liberi = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autori del libro</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/crud.css">
</head>

<body>
    <header>
        <h1>✍️ Autori di "<?= htmlspecialchars($libro['titolo']) ?>"</h1>
        <p><a href="libri.php">⬅️ Torna ai libri</a></p>
    </header>

    <main>
        <?php if ($messaggio != '') { ?>
            <p><?= htmlspecialchars($messaggio) ?></p>
        <?php } ?>

        <form action="libro_autori_insert.php" method="post">
            <h2>Collega un autore</h2>
            <input type="hidden" name="libro_id" value="<?= $libro['id'] ?>">
            <label for="autore_id">Autore</label>
            <select name="autore_id" id="autore_id" required>
                <?php foreach ($autori_liberi as $a) { ?>
                    <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['nome'] . ' ' . $a['cognome']) ?></option>
                <?php } ?>
            </select>
            <label for="ruolo">Ruolo</label>
            <input type="text" name="ruolo" id="ruolo" value="Autore" required>
            <button type="submit">Collega</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Autore</th>
                    <th>Ruolo</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($autori_libro as $a) { ?>
                    <tr>
                        <td><?= htmlspecialchars($a['nome'] . ' ' . $a['cognome']) ?></td>
                        <td><?= htmlspecialchars($a['ruolo']) ?></td>
                        <td>
                            <a href="libro_autori_delete.php?libro_id=<?= $libro['id'] ?>&autore_id=<?= $a['id'] ?>" onclick="return confirm('Scollegare l\'autore?');">Scollega</a>
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
