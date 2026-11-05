# Lezione 3 - Modificare

**Obiettivo**: cambiare il nome di una categoria.

Servono **due** pagine: una per mostrare il form già compilato (`edit`), una per salvare (`update`).

## `categorie_edit.php?id=...`

1. Leggi la riga da modificare (una sola riga, quindi `fetch()` e non `fetchAll()`):

   ```php
   $id = $_GET['id'];

   $stmt = $pdo->prepare("SELECT id, nome FROM categorie WHERE id = ?");
   $stmt->execute([$id]);
   $categoria = $stmt->fetch();
   ```

2. Mostra un form con il valore attuale. L'`id` non si deve modificare, ma serve alla pagina successiva: lo mandiamo con un campo **nascosto**.

   ```html
   <form action="categorie_update.php" method="post">
       <input type="hidden" name="id" value="<?= $categoria['id'] ?>">
       <input type="text" name="nome" value="<?= htmlspecialchars($categoria['nome']) ?>" required>
       <button type="submit">Salva</button>
   </form>
   ```

3. In `categorie.php` aggiungi il link `<a href="categorie_edit.php?id=<?= $c['id'] ?>">Modifica</a>`.

## `categorie_update.php`

```php
$id = $_POST['id'];
$nome = trim($_POST['nome']);

$stmt = $pdo->prepare("UPDATE categorie SET nome = ? WHERE id = ?");
$stmt->execute([$nome, $id]);

header("Location: categorie.php");
exit;
```

Attenzione all'**ordine**: il primo `?` è `nome`, il secondo è `id`, quindi `[$nome, $id]`.

## Verifica

Modifica "Giallo" in "Thriller". Se non sai dov'è l'errore, controlla l'ordine dei valori nell'array.
