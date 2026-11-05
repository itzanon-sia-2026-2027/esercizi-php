# Lezioni: dal primo SELECT al portale gestionale

Si riparte da zero e si costruisce un **portale gestionale per una biblioteca**, un passo alla volta.
La soluzione completa e funzionante è nella cartella [`../biblioteca/`](../biblioteca/): usala per confrontare il tuo lavoro, non per copiare.

## Prima di iniziare

1. Crea una cartella di lavoro tua, ad esempio `miabiblioteca/`, dentro il progetto.
2. Copia da `biblioteca/` solo la cartella `css/` (lo stile è già pronto).
3. Il database `database/biblioteca.sqlite` si crea da solo, con i dati di esempio (guarda `database/schema_sqlite.sql`). Per ricominciare cancella il file `.sqlite`.
4. Avvia il server con il task **"4. Avvia Server PHP (file corrente)"** del profilo VSCode.

Lo schema del database:

```
categorie (id, nome)                      1 ──< N   libri (id, titolo, anno_pubblicazione, categoria_id)
libri  >──< autori (id, nome, cognome)    N:M tramite libro_autore (libro_id, autore_id, ruolo)
```

## Convenzioni (le stesse usate in classe)

- Ogni pagina inizia con `require_once 'connessione.php';` e usa la variabile `$pdo`.
- **Un file per ogni operazione**: `categorie.php`, `categorie_insert.php`, `categorie_delete.php`, `categorie_edit.php`, `categorie_update.php`.
- Le query con dati dell'utente usano **sempre `prepare` con i segnaposto `?`** e `execute([ ... ])`:

  ```php
  $stmt = $pdo->prepare("UPDATE autori SET nome = ?, cognome = ? WHERE id = ?");
  $stmt->execute([$nome, $cognome, $id]);
  ```

  I valori nell'array vanno **nello stesso ordine** dei `?`. Non si usano i parametri con nome.
- Dopo una scrittura: `header("Location: pagina.php"); exit;`.
- Ogni dato mostrato in pagina passa da `htmlspecialchars()`.

## Sequenza

| # | Lezione | Argomento |
|---|---------|-----------|
| 1 | [Leggere i dati](lezione-01.md) | connessione, `query`, `fetchAll`, tabella HTML |
| 2 | [Inserire e cancellare](lezione-02.md) | form, `prepare`/`execute`, redirect |
| 3 | [Modificare](lezione-03.md) | `fetch`, `<input type="hidden">`, `UPDATE` |
| 4 | [Messaggi ed errori](lezione-04.md) | sessione, `try/catch`, chiavi esterne |
| 5 | [Seconda tabella: libri](lezione-05.md) | `INNER JOIN`, menu a tendina |
| 6 | [Relazione N:M: autori dei libri](lezione-06.md) | tabella ponte, padre-figlio |
| 7 | [Il catalogo pubblico](lezione-07.md) | pagina finale, cicli annidati, home del portale |
| 8 | [Ultima lezione: fetch](lezione-08.md) | JavaScript che chiede a PHP pezzi di HTML |

Alla fine della lezione 7 hai un portale completo. Cambiando tabelle e campi puoi costruire lo stesso portale per qualsiasi altro tema (negozio, palestra, scuola...).
