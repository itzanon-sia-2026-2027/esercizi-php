# Lezione 7 - Il catalogo pubblico e la home del portale

**Obiettivo**: la pagina che vede il pubblico, e da cui si accede alle pagine di gestione.

## `index.php`

1. Leggi tutti i libri con la JOIN sulle categorie (come in lezione 5).
2. Per **ogni libro** esegui una seconda query per gli autori. Il ciclo annidato è:

   ```php
   <?php foreach ($libri as $l) {
       $sql = "SELECT autori.nome, autori.cognome, libro_autore.ruolo
               FROM autori
               INNER JOIN libro_autore ON autori.id = libro_autore.autore_id
               WHERE libro_autore.libro_id = ?";
       $stmt = $pdo->prepare($sql);
       $stmt->execute([$l['id']]);
       $autori = $stmt->fetchAll(); ?>
       <article>
           <h2><?= htmlspecialchars($l['titolo']) ?></h2>
           <ul>
               <?php foreach ($autori as $a) { ?>
                   <li><?= htmlspecialchars($a['nome'] . ' ' . $a['cognome']) ?> - <?= htmlspecialchars($a['ruolo']) ?></li>
               <?php } ?>
           </ul>
       </article>
   <?php } ?>
   ```

   Anche qui si usa `?`, perché `$l['id']` viene dal database: è una buona abitudine usare **sempre** `prepare`.
3. Nell'header metti i link a `categorie.php`, `libri.php`, `autori.php`.

## Rifinitura

Nelle pagine di gestione aggiungi un link "⬅️ Home". Hai un portale completo: **home → liste → inserimento / modifica / cancellazione → relazioni**.

## Esercizio per la verifica

Realizza lo stesso portale con un altro tema, sulla stessa struttura:

| Tema | Tabella 1:N | Tabella principale | N:M |
|------|-------------|--------------------|-----|
| Palestra | `sale` | `corsi` | `corsi` ↔ `istruttori` |
| Negozio | `reparti` | `prodotti` | `prodotti` ↔ `fornitori` |
| Scuola | `indirizzi` | `classi` | `classi` ↔ `docenti` (con materia) |
