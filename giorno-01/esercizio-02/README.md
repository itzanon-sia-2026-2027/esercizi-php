# Esercizio 2: Lista Studenti

## 🎯 Obiettivo

Creare una pagina PHP che visualizza l'elenco di tutti gli studenti presenti nel database in una tabella HTML formattata.

## 📝 Descrizione

In questo esercizio imparerai a:
- Eseguire una query SELECT per recuperare dati
- Iterare sui risultati di una query
- Visualizzare dati in formato tabella HTML
- Gestire il caso di risultati vuoti

## 🔧 Requisiti

1. Connettersi al database
2. Eseguire query SELECT per ottenere tutti gli studenti
3. Controllare se ci sono risultati
4. Visualizzare dati in una tabella HTML ben formattata
5. Mostrare: ID, Nome, Cognome, Email, Città, Corso
6. Gestire il caso in cui non ci siano studenti nel database

## 💻 File da Creare

- `index.php` - File principale con query e visualizzazione

## 📚 Funzioni PHP da Usare

- `$pdo->query()` - Esegue la query
- `$stmt->fetchAll()` - Recupera tutte le righe come array associativi
- `count()` - Conta il numero di risultati
- `htmlspecialchars()` - Sanitizza output HTML

## 🎨 Output Atteso

Una tabella HTML con intestazioni:
```
| ID | Nome | Cognome | Email | Città | Corso |
|----|------|---------|-------|-------|-------|
| 1  | Mario| Rossi   | mario@| Roma  | Info  |
...
```

## 💡 Suggerimenti

1. Usa `foreach ($studenti as $studente)` per iterare sui risultati di `fetchAll()`
2. Controlla sempre con `count()` se ci sono risultati
3. Usa CSS per rendere la tabella più leggibile
4. Sanitizza sempre l'output con `htmlspecialchars()`

## 🚀 Bonus (Opzionale)

- Aggiungi un contatore del numero totale di studenti
- Colora le righe alternate (zebra striping)
- Aggiungi ordinamento per colonna
- Formatta la data di nascita in formato italiano
- Aggiungi icone per città o corso

## 📖 Query SQL di Riferimento

```sql
SELECT id, nome, cognome, email, citta, corso 
FROM studenti 
ORDER BY cognome, nome;
```

## ✅ Test

1. Apri `index.php` in VSCode ed esegui il task **"4. Avvia Server PHP (file corrente)"** (pulsante ▶️ nel pannello Favorites), oppure da terminale nella cartella principale del progetto: `php -S localhost:3000`
   Il browser si apre su `http://localhost:3000/giorno-01/esercizio-02/index.php`

2. Verifica che vengano visualizzati tutti e 5 gli studenti di esempio

3. Prova a svuotare temporaneamente la tabella per testare il messaggio di "nessun risultato"
