# Lezione 1 - Leggere i dati

**Obiettivo**: mostrare in una tabella HTML l'elenco delle categorie.

## 1. `connessione.php`

Crea la connessione una volta sola. Prendi come riferimento `biblioteca/connessione.php`: legge `config/db_config.php` (SQLite o MySQL, a scelta tua) e ti lascia pronta la variabile `$pdo`.

Nota: `$pdo` è l'oggetto che usi per parlare con il database.

## 2. `categorie.php`

All'inizio del file, nel blocco PHP:

```php
<?php
require_once 'connessione.php';

$categorie = $pdo->query("SELECT id, nome FROM categorie ORDER BY nome")->fetchAll();
?>
```

- `query()` esegue la SELECT.
- `fetchAll()` restituisce un array di righe; ogni riga è un array associativo (`$c['nome']`).

Nella parte HTML stampa una riga `<tr>` per ogni categoria:

```php
<?php foreach ($categorie as $c) { ?>
    <tr>
        <td><?= $c['id'] ?></td>
        <td><?= htmlspecialchars($c['nome']) ?></td>
    </tr>
<?php } ?>
```

`<?= ... ?>` è la scrittura abbreviata di `<?php echo ... ?>`.

## Verifica

Aprendo `categorie.php` nel browser vedi le 4 categorie di esempio.

## Per approfondire

Prova a cambiare `ORDER BY nome` in `ORDER BY nome DESC`. Cosa cambia?
