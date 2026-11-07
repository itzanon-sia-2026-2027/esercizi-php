<?php
require_once 'connessione.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT id, nome, cognome FROM autori WHERE id = ?");
$stmt->execute([$id]);
$autore = $stmt->fetch();

if (!$autore) {
    $_SESSION['messaggio'] = 'Autore non trovato';
    header("Location: autori.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Autore</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/crud.css">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
</head>

<body>
    <header>
        <h1>✏️ Modifica Autore</h1>
        <p><a href="autori.php">⬅️ Torna agli autori</a></p>
    </header>

    <main>
        <form action="autori_update.php" method="post">
            <input type="hidden" name="id" value="<?= $autore['id'] ?>">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($autore['nome']) ?>" required>
            <label for="cognome">Cognome</label>
            <input type="text" name="cognome" id="cognome" value="<?= htmlspecialchars($autore['cognome']) ?>" required>
            <button type="submit">Salva</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2026 5B SIA</p>
    </footer>
</body>

</html>
