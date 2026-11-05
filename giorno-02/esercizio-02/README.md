# Esercizio 2: Modifica ed Elimina Studente

## 🎯 Obiettivo

Creare un'interfaccia completa per modificare i dati di uno studente esistente ed eliminare studenti dal database.

## 📝 Descrizione

In questo esercizio imparerai a:
- Caricare dati esistenti in un form
- Eseguire operazioni UPDATE
- Implementare DELETE con conferma
- Gestire diverse operazioni sulla stessa pagina
- Usare redirect dopo operazioni di successo
- Implementare conferme JavaScript per azioni pericolose

## 🔧 Requisiti

### Parte 1: Modifica Studente
1. Ricevere ID studente via GET
2. Caricare dati attuali dello studente
3. Mostrare form precompilato
4. Permettere modifica di tutti i campi
5. Validare input come nell'esercizio 1
6. Eseguire UPDATE con prepared statement
7. Mostrare messaggio di conferma

### Parte 2: Elimina Studente
1. Pulsante "Elimina" nella pagina di modifica
2. Conferma JavaScript prima di eliminare
3. Eseguire DELETE con prepared statement
4. Redirect alla lista studenti dopo eliminazione

## 💻 File da Creare

- `index.php` - Form modifica e gestione operazioni
- `elimina.php` (opzionale) - Script separato per eliminazione

## 📚 Funzioni PHP da Usare

- `$pdo->prepare()` ed `$stmt->execute()` - Per UPDATE e DELETE sicuri
- `$stmt->rowCount()` - Verifica quante righe sono state modificate
- `header('Location: ...')` - Redirect dopo operazioni
- `exit()` - Termina script dopo redirect

## 🎨 Output Atteso

Form precompilato con i dati attuali e messaggi:
- ✅ "Dati studente aggiornati con successo!"
- ✅ "Studente eliminato con successo" (dopo redirect)
- ❌ Messaggi di errore appropriati

## 💡 Suggerimenti

1. Verifica sempre che l'ID esista prima di mostrare il form
2. Usa `value="<?php echo htmlspecialchars($studente['nome']); ?>"` per precompilare
3. Per eliminazione, usa conferma JavaScript: `onclick="return confirm('Sei sicuro?')"`
4. Dopo UPDATE o DELETE, usa redirect per evitare re-submit
5. Considera l'uso di un campo hidden per distinguere tra update e delete

## 🚀 Bonus (Opzionale)

- Aggiungi pulsante "Annulla" che torna ai dettagli senza salvare
- Log delle modifiche (chi ha modificato cosa e quando)
- Soft delete (campo `deleted_at` invece di eliminazione fisica)
- Cronologia modifiche
- Conferma via modal invece di alert JavaScript

## 📖 Query SQL di Riferimento

### UPDATE
```sql
UPDATE studenti 
SET nome = ?, cognome = ?, email = ?, data_nascita = ?, citta = ?, corso = ?
WHERE id = ?;
```

### DELETE
```sql
DELETE FROM studenti WHERE id = ?;
```

### Verifica esistenza
```sql
SELECT id FROM studenti WHERE id = ?;
```

## ✅ Test

1. Apri `index.php` in VSCode ed esegui il task **"4. Avvia Server PHP (file corrente)"** (pulsante ▶️ nel pannello Favorites), oppure da terminale nella cartella principale del progetto: `php -S localhost:3000`
   Il browser si apre su `http://localhost:3000/giorno-02/esercizio-02/index.php`

2. Test da eseguire:
   - `?id=1` → Deve mostrare form precompilato con dati di studente #1
   - Modifica alcuni campi e salva → Deve aggiornare e confermare
   - Verifica in database che i dati siano cambiati
   - Prova eliminazione → Deve chiedere conferma
   - Conferma eliminazione → Deve eliminare e redirect
   - Verifica in database che il record sia stato eliminato
   - `?id=999` → Deve mostrare "Studente non trovato"

## ⚠️ Sicurezza

```php
// ✅ Prepared statement per UPDATE
$stmt = $pdo->prepare("UPDATE studenti SET nome = :nome, email = :email WHERE id = :id");
$stmt->execute(['nome' => $nome, 'email' => $email, 'id' => $id]);

// ✅ Prepared statement per DELETE
$stmt = $pdo->prepare("DELETE FROM studenti WHERE id = :id");
$stmt->execute(['id' => $id]);

// ✅ SEMPRE redirect dopo operazioni di modifica (Pattern Post-Redirect-Get)
header('Location: lista.php?msg=success');
exit();
```

## 🔄 Pattern Post-Redirect-Get

Per evitare re-submit del form quando l'utente ricarica la pagina:

1. POST → Elabora dati
2. Se successo → Redirect a pagina GET
3. GET → Mostra messaggio di conferma
