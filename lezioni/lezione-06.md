# Lezione 6 - Relazione N:M: gli autori dei libri (padre-figlio)

**Obiettivo**: un libro può avere più autori e un autore più libri. Con in più un dato sul collegamento: il **ruolo** (Autore, Curatore, Prefazione...).

## 1. CRUD degli autori

Ripeti ancora lo schema di lezioni 1-4 per `autori` (`autori.php`, `autori_insert.php`, `autori_delete.php`, `autori_edit.php`, `autori_update.php`). Ha due campi, quindi nella query ci sono due (o tre, nell'update) `?`.

## 2. La tabella ponte `libro_autore`

Una N:M si realizza con una terza tabella con **due chiavi esterne** e la chiave primaria composta:

```sql
CREATE TABLE libro_autore (
    libro_id INTEGER NOT NULL,
    autore_id INTEGER NOT NULL,
    ruolo TEXT NOT NULL,
    PRIMARY KEY (libro_id, autore_id),
    FOREIGN KEY (libro_id) REFERENCES libri(id) ON DELETE CASCADE,
    FOREIGN KEY (autore_id) REFERENCES autori(id) ON DELETE CASCADE
);
```

Con `CASCADE`, cancellando un libro (o un autore) spariscono anche i suoi collegamenti.

## 3. La pagina "padre-figlio": `libro_autori.php?id=...`

Parte da un libro (il **padre**) e ne gestisce gli autori collegati (i **figli**).

- In `libri.php` aggiungi il link `libro_autori.php?id=<?= $l['id'] ?>`.
- Gli autori già collegati (JOIN con la tabella ponte):

  ```php
  $sql = "SELECT autori.id, autori.nome, autori.cognome, libro_autore.ruolo
          FROM autori
          INNER JOIN libro_autore ON autori.id = libro_autore.autore_id
          WHERE libro_autore.libro_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$libro_id]);
  $autori_libro = $stmt->fetchAll();
  ```

- Il menu a tendina propone solo gli autori **non ancora** collegati:

  ```php
  SELECT id, nome, cognome FROM autori
  WHERE id NOT IN (SELECT autore_id FROM libro_autore WHERE libro_id = ?)
  ```

- Il form invia `libro_id` (campo hidden), `autore_id` e `ruolo` a `libro_autori_insert.php`, che fa l'`INSERT` nella tabella ponte e poi torna a `libro_autori.php?id=` + il libro.
- Il link "Scollega" chiama `libro_autori_delete.php?libro_id=...&autore_id=...`: servono **entrambe** le chiavi, perché la riga è identificata dalla coppia:

  ```php
  DELETE FROM libro_autore WHERE libro_id = ? AND autore_id = ?
  ```

## Verifica

Collega un secondo autore a "Dune", poi scollegalo. Cancella un libro e controlla che i collegamenti siano spariti.
