# Lezione 2 - Inserire e cancellare

**Obiettivo**: aggiungere ed eliminare categorie.

## Inserimento

1. In `categorie.php`, sopra la tabella, aggiungi un form:

   ```html
   <form action="categorie_insert.php" method="post">
       <label for="nome">Nome</label>
       <input type="text" name="nome" id="nome" required>
       <button type="submit">Aggiungi</button>
   </form>
   ```

2. Crea `categorie_insert.php`. Questa pagina **non mostra nulla**: fa il lavoro e torna alla lista.

   ```php
   <?php
   require_once 'connessione.php';

   $nome = trim($_POST['nome']);

   $stmt = $pdo->prepare("INSERT INTO categorie (nome) VALUES (?)");
   $stmt->execute([$nome]);

   header("Location: categorie.php");
   exit;
   ```

**Perché `?` e non `"... VALUES ('$nome')"`?** Con `prepare` il valore viaggia separato dalla query: un utente malintenzionato non può "inventare" SQL scrivendolo nel form (SQL injection).

## Cancellazione

1. Nella tabella aggiungi una colonna con il link:

   ```php
   <a href="categorie_delete.php?id=<?= $c['id'] ?>" onclick="return confirm('Cancellare la categoria?');">Elimina</a>
   ```

   Se `confirm` restituisce `false` il link non viene seguito.

2. Crea `categorie_delete.php`: legge `$_GET['id']`, esegue `DELETE FROM categorie WHERE id = ?` e torna a `categorie.php`.

## Verifica

Aggiungi "Poesia", poi eliminala. Prova ad aggiungere una categoria con il nome già esistente: cosa succede? (lo risolviamo nella lezione 4)
