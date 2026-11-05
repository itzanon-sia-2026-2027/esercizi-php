# Lezione 4 - Messaggi ed errori

**Obiettivo**: dire all'utente cosa è successo ed evitare le pagine bianche con errori.

## Il problema

Dopo un `header("Location: ...")` la pagina cambia: non possiamo più usare una variabile per dare un messaggio. Usiamo la **sessione**, che sopravvive tra una pagina e l'altra.

## La soluzione (già in `connessione.php`)

- `session_start();` attiva la sessione.
- Le pagine `*_insert/update/delete.php` scrivono il messaggio: `$_SESSION['messaggio'] = 'Categoria aggiunta';`
- `connessione.php` lo legge, lo mette in `$messaggio` e lo **cancella** (`unset`), così compare una volta sola.
- `categorie.php` lo mostra:

  ```php
  <?php if ($messaggio != '') { ?>
      <p><?= htmlspecialchars($messaggio) ?></p>
  <?php } ?>
  ```

## try / catch

Se il database rifiuta un'operazione, PDO lancia una `PDOException`. La catturiamo:

```php
try {
    $stmt = $pdo->prepare("INSERT INTO categorie (nome) VALUES (?)");
    $stmt->execute([$nome]);
    $_SESSION['messaggio'] = 'Categoria aggiunta';
} catch (PDOException $e) {
    $_SESSION['messaggio'] = 'Errore: ' . $e->getMessage();
}
```

Aggiungi anche un controllo: se `$nome == ''` il messaggio è "Il nome è obbligatorio" e non si esegue nessuna query (la validazione si fa **sempre** sul server).

## Integrità referenziale

Nel database `libri.categoria_id` ha `ON DELETE RESTRICT`: **non si può cancellare una categoria che ha dei libri**. Ora che gestisci l'errore, in `categorie_delete.php` scrivi un messaggio chiaro: "Impossibile eliminare: ci sono libri collegati".

Regole principali per le chiavi esterne:

| Regola | Cosa succede cancellando il padre |
|--------|-----------------------------------|
| `RESTRICT` | l'operazione viene rifiutata |
| `CASCADE` | vengono cancellati anche i figli |
| `SET NULL` | i figli restano con la chiave a `NULL` |

## Verifica

Prova a cancellare "Giallo" (ha dei libri) e a creare due volte la stessa categoria.
