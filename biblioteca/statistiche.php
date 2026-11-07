<?php
require_once 'connessione.php';

// 1. QUERY: Conteggio dei libri suddivisi per ogni categoria (con LEFT JOIN)
$sql_categorie = "SELECT categorie.nome AS categoria, COUNT(libri.id) AS totale_libri
                  FROM categorie
                  LEFT JOIN libri ON categorie.id = libri.categoria_id
                  GROUP BY categorie.id, categorie.nome
                  ORDER BY totale_libri DESC, categorie.nome";
$stmt_cat = $pdo->prepare($sql_categorie);
$stmt_cat->execute();
$stat_categorie = $stmt_cat->fetchAll();

// 2. QUERY: Calcolo della media degli autori per libro raggruppati per categoria
$sql_media_autori = "SELECT categorie.nome AS categoria, 
                            ROUND(AVG(conteggio_autori.num_autori), 1) AS media_autori
                     FROM categorie
                     INNER JOIN libri ON categorie.id = libri.categoria_id
                     INNER JOIN (
                         SELECT libro_id, COUNT(autore_id) AS num_autori 
                         FROM libro_autore 
                         GROUP BY libro_id
                     ) AS conteggio_autori ON libri.id = conteggio_autori.libro_id
                     GROUP BY categorie.id, categorie.nome
                     ORDER BY media_autori DESC";
$stmt_autori = $pdo->prepare($sql_media_autori);
$stmt_autori->execute();
$stat_autori = $stmt_autori->fetchAll();
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiche Biblioteca</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/crud.css"> 
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
</head>

<body>
    <header>
        <h1>📊 Statistiche del Catalogo</h1>
        <p>Prospetto quantitativo della biblioteca</p>
        <p><a href="index.php">🏠 Torna alla Ricerca</a></p>
    </header>

    <main>
        <section>
            <h2>Libri per Categoria</h2>
            <table>
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Numero di Libri</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($stat_categorie as $cat) { ?>
                        <tr>
                            <td><?= htmlspecialchars($cat['categoria']) ?></td>
                            <td><strong><?= (int)$cat['totale_libri'] ?></strong></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Media Autori per Categoria</h2>
            <table>
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Media Autori</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($stat_autori as $aut) { ?>
                        <tr>
                            <td><?= htmlspecialchars($aut['categoria']) ?></td>
                            <td><?= $aut['media_autori'] ?> autori/libro</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 5B SIA</p>
    </footer>
</body>

</html>
