<?php
require_once 'connessione.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT id, nome FROM categorie WHERE id = ?");
$stmt->execute([$id]);
$categoria = $stmt->fetch();

if (!$categoria) {
    $_SESSION['messaggio'] = 'Categoria non trovata';
    header("Location: categorie.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Categoria</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/crud.css">
</head>

<body>
    <header>
        <h1>✏️ Modifica Categoria</h1>
        <p><a href="categorie.php">⬅️ Torna alle categorie</a></p>
    </header>

    <main>
        <form action="categorie_update.php" method="post">
            <input type="hidden" name="id" value="<?= $categoria['id'] ?>">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($categoria['nome']) ?>" required>
            <button type="submit">Salva</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2026 5B SIA</p>
    </footer>
</body>

</html>
