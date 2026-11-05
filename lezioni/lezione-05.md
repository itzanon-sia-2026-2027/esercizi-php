# Lezione 5 - La seconda tabella: libri (JOIN e menu a tendina)

**Obiettivo**: gestire i libri, che appartengono a una categoria (relazione 1:N).

Ripeti le lezioni 1-4 per la tabella `libri`, con i file `libri.php`, `libri_insert.php`, `libri_delete.php`, `libri_edit.php`, `libri_update.php`. Le novità sono due.

## 1. INNER JOIN: mostrare il nome e non il numero

In tabella non vogliamo "categoria 3" ma "Giallo". Si uniscono le tabelle:

```php
$sql = "SELECT libri.id,
               libri.titolo,
               libri.anno_pubblicazione,
               categorie.nome AS categoria
        FROM libri
        INNER JOIN categorie ON libri.categoria_id = categorie.id
        ORDER BY libri.titolo";
$libri = $pdo->query($sql)->fetchAll();
```

`AS categoria` dà un nome alla colonna: nel ciclo usi `$l['categoria']`.

## 2. Menu a tendina costruito dal database

Il form di inserimento deve far scegliere la categoria. Prima leggi le categorie, poi crei le `<option>`:

```php
<select name="categoria_id" required>
    <?php foreach ($categorie as $c) { ?>
        <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
    <?php } ?>
</select>
```

All'utente si mostra il **nome**, al server si invia l'**id** (`value`).

Nella pagina di modifica la categoria attuale deve essere preselezionata:

```php
<option value="<?= $c['id'] ?>" <?php if ($c['id'] == $libro['categoria_id']) { echo 'selected'; } ?>>
```

## Verifica

Inserisci un libro, modificane la categoria, poi prova a cancellare una categoria usata.
