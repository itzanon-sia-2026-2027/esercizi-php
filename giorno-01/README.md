# Giorno 1 - Fondamenti PHP e PDO

Benvenuto al primo giorno di esercizi! Oggi imparerai le basi di PHP e come connetterti e interrogare un database (SQLite o MySQL) usando PDO.

## 🎯 Obiettivi del Giorno

- Comprendere la sintassi base di PHP
- Stabilire connessione a un database MySQL
- Eseguire query SELECT
- Visualizzare dati in formato HTML

## 📚 Concetti Trattati

1. **Variabili e tipi di dati in PHP**
2. **Connessione al database con `new PDO()`**
3. **Esecuzione query con `$pdo->query()` e `$pdo->prepare()`**
4. **Lettura dati con `fetch()` e `fetchAll()`**
5. **Gestione errori con `try/catch` e `PDOException`**

## 📋 Esercizi

### Esercizio 1: Prima Connessione
**Difficoltà**: ⭐ Facile

Crea un file PHP che si connette al database e visualizza un messaggio di conferma.

**Obiettivi**:
- Includere file di configurazione
- Stabilire connessione
- Gestire errori di connessione
- Chiudere connessione

[Vai all'esercizio →](./esercizio-01/)

---

### Esercizio 2: Lista Studenti
**Difficoltà**: ⭐⭐ Medio

Visualizza l'elenco completo degli studenti presenti nel database in una tabella HTML.

**Obiettivi**:
- Eseguire query SELECT
- Iterare sui risultati
- Formattare output in HTML
- Gestire risultati vuoti

[Vai all'esercizio →](./esercizio-02/)

---

### Esercizio 3: Dettagli Studente
**Difficoltà**: ⭐⭐ Medio

Mostra i dettagli di uno studente specifico basandosi su un parametro GET.

**Obiettivi**:
- Ricevere parametri GET
- Query con clausola WHERE
- Sanitizzazione input
- Gestione record non trovato

[Vai all'esercizio →](./esercizio-03/)

---

## 💡 Suggerimenti

1. **Controlla sempre gli errori**: Racchiudi il codice in `try { ... } catch (PDOException $e)` e leggi `$e->getMessage()`
2. **Chiudi le connessioni**: Con PDO basta assegnare `null` alla variabile (`$pdo = null;`)
3. **Sanitizza input**: Usa `htmlspecialchars()` per output HTML
4. **Testa il database**: Verifica che i dati di esempio siano presenti

## 🔗 Risorse Utili

- [PDO - Manuale PHP](https://www.php.net/manual/it/book.pdo.php)
- [PDO::prepare](https://www.php.net/manual/it/pdo.prepare.php)
- [Driver PDO SQLite](https://www.php.net/manual/it/ref.pdo-sqlite.php)

## ✅ Checklist di Completamento

Dopo aver completato gli esercizi, dovresti essere in grado di:

- [ ] Connetterti a un database con PDO
- [ ] Eseguire una query SELECT
- [ ] Visualizzare dati in formato tabella HTML
- [ ] Gestire errori di connessione e query
- [ ] Passare parametri via URL (GET)
- [ ] Sanitizzare input e output

## 🚀 Prossimo Giorno

Nel **Giorno 2** imparerai le operazioni CRUD (Create, Read, Update, Delete) per gestire i dati nel database.
