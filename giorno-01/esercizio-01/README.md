# Esercizio 1: Prima Connessione al Database

## 🎯 Obiettivo

Creare un file PHP che si connette al database MySQL e mostra un messaggio di conferma della connessione riuscita.

## 📝 Descrizione

Questo è il tuo primo esercizio con PHP e MySQL. Imparerai a:
- Includere file di configurazione
- Stabilire una connessione al database
- Gestire eventuali errori di connessione
- Chiudere correttamente la connessione

## 🔧 Requisiti

1. Includere il file di configurazione del database
2. Stabilire connessione con `connetti_database()` (che usa `new PDO()`)
3. Gestire un eventuale errore con `try/catch` (`PDOException`)
4. Mostrare messaggio di successo o errore
5. Chiudere la connessione

## 💻 File da Creare

- `index.php` - File principale dell'esercizio

## 📚 Funzioni PHP da Usare

- `new PDO()` - Crea connessione al database
- `PDOException::getMessage()` - Ritorna il messaggio di errore
- `$pdo = null` - Chiude connessione

## 🎨 Output Atteso

```
✅ Connessione al database riuscita!
Database: esercizi_php
```

oppure in caso di errore:

```
❌ Errore di connessione: [messaggio errore]
```

## 💡 Suggerimenti

1. Controlla `DB_DRIVER` in `config/db_config.php` (`'sqlite'` funziona subito, senza installare nulla)
2. Usa `require_once` per includere i file di configurazione
3. Controlla sempre se la connessione è valida prima di usarla
4. Usa CSS inline o semplice per migliorare la presentazione

## 🚀 Bonus (Opzionale)

- Mostra informazioni aggiuntive come versione MySQL
- Aggiungi stili CSS per rendere l'output più gradevole
- Mostra il charset della connessione

## 📖 Esempio di Codice di Partenza

```php
<?php
// Includi configurazione database
require_once '../../config/db_config.php';

try {
    // TODO: Crea connessione con connetti_database()

    // TODO: Mostra messaggio di successo

    // TODO: Chiudi connessione
} catch (PDOException $e) {
    // TODO: Mostra messaggio di errore
}
?>
```

## ✅ Test

Per verificare che l'esercizio funzioni:

1. Apri `index.php` in VSCode ed esegui il task **"4. Avvia Server PHP (file corrente)"** (pulsante ▶️ nel pannello Favorites), oppure da terminale nella cartella principale del progetto: `php -S localhost:3000`
   Il browser si apre su `http://localhost:3000/giorno-01/esercizio-01/index.php`

2. Dovresti vedere il messaggio di connessione riuscita
