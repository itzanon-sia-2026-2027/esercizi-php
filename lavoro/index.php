<?php
require_once 'connessione.php';

$categorie = $pdo->query("SELECT * FROM categorie;")->fetchAll();

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/crud.css">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <title>TEST</title>
</head>

<body>
    <header>
        <h1>Pagina di test</h1>
    </header>
    <main>
        <pre>
        <?= var_export($categorie) ?> ?>
    </pre>
    </main>
    <footer></footer>
</body>

</html>