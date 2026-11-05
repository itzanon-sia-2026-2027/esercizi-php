# Esercizio 3: Dettagli Studente

## 🎯 Obiettivo

Creare una pagina PHP che mostra i dettagli completi di uno studente specifico basandosi su un parametro ID passato via URL (GET).

## 📝 Descrizione

In questo esercizio imparerai a:
- Ricevere e gestire parametri GET dall'URL
- Eseguire query con clausola WHERE
- Sanitizzare input utente
- Gestire il caso di record non trovato
- Visualizzare dati in formato card/dettaglio

## 🔧 Requisiti

1. Ricevere l'ID dello studente tramite parametro GET
2. Validare che l'ID sia un numero
3. Eseguire query SELECT con WHERE per trovare lo studente
4. Visualizzare tutti i dettagli dello studente in formato card
5. Gestire il caso di studente non trovato
6. Fornire link per tornare alla lista

## 💻 File da Creare

- `index.php` - File principale con query e visualizzazione dettagli

## 📚 Funzioni PHP da Usare

- `$_GET['parametro']` - Riceve parametri dall'URL
- `isset()` - Verifica se una variabile esiste
- `is_numeric()` - Verifica se un valore è numerico
- `$pdo->prepare()` ed `$stmt->execute()` - Query con parametri (per sicurezza)
- `$stmt->fetch()` - Recupera la riga (o `false` se non esiste)

## 🎨 Output Atteso

Una card con i dettagli dello studente:

```
╔════════════════════════════╗
║  Mario Rossi               ║
║  ID: #1                    ║
║  📧 mario.rossi@email.com  ║
║  📅 15/05/2000             ║
║  📍 Roma                   ║
║  🎓 Informatica            ║
╚════════════════════════════╝
```

## 💡 Suggerimenti

1. Controlla sempre se l'ID è presente e valido prima di fare la query
2. Usa prepared statements per prevenire SQL injection
3. Gestisci il caso di ID non trovato con un messaggio appropriato
4. Aggiungi un link "← Torna alla lista" per navigare

## 🚀 Bonus (Opzionale)

- Mostra anche i corsi a cui lo studente è iscritto (JOIN con tabella iscrizioni)
- Aggiungi pulsanti per modificare o eliminare lo studente (solo UI, non funzionanti)
- Mostra l'età calcolata dalla data di nascita
- Aggiungi un'immagine avatar generica

## 📖 Query SQL di Riferimento

```sql
SELECT * FROM studenti WHERE id = ?;
```

## 🔗 URL di Esempio

```
http://localhost:3000/giorno-01/esercizio-03/index.php?id=1
http://localhost:3000/giorno-01/esercizio-03/index.php?id=3
```

## ✅ Test

1. Apri `index.php` in VSCode ed esegui il task **"4. Avvia Server PHP (file corrente)"** (pulsante ▶️ nel pannello Favorites), oppure da terminale nella cartella principale del progetto: `php -S localhost:3000`
   Il browser si apre su `http://localhost:3000/giorno-01/esercizio-03/index.php`

2. Testa con diversi ID:
   - `?id=1` - Dovrebbe mostrare Mario Rossi
   - `?id=999` - Dovrebbe mostrare "Studente non trovato"
   - `?id=abc` - Dovrebbe mostrare errore "ID non valido"
   - Nessun parametro - Dovrebbe mostrare messaggio appropriato

## ⚠️ Sicurezza

- SEMPRE sanitizzare/validare input utente
- Usare prepared statements per query con parametri
- Non fidarsi mai dei dati ricevuti dall'utente
