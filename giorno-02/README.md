# Giorno 2 - Operazioni CRUD

Benvenuto al secondo giorno di esercizi! Oggi imparerai a eseguire tutte le operazioni CRUD (Create, Read, Update, Delete) su un database MySQL.

## 🎯 Obiettivi del Giorno

- Inserire nuovi record nel database (CREATE)
- Leggere e visualizzare dati (READ - già visto ieri)
- Modificare record esistenti (UPDATE)
- Eliminare record dal database (DELETE)
- Gestire form HTML con PHP
- Validare input utente

## 📚 Concetti Trattati

1. **Form HTML e metodi POST/GET**
2. **INSERT: Inserimento dati con `prepare()` ed `execute()`**
3. **UPDATE: Modifica dati esistenti**
4. **DELETE: Cancellazione record**
5. **Prepared Statements per sicurezza**
6. **Validazione e sanitizzazione input**
7. **Redirect dopo operazioni**

## 📋 Esercizi

### Esercizio 1: Inserisci Nuovo Studente
**Difficoltà**: ⭐⭐ Medio

Crea un form per inserire un nuovo studente nel database e gestisci l'inserimento.

**Obiettivi**:
- Creare form HTML con metodo POST
- Validare tutti i campi obbligatori
- Eseguire query INSERT
- Gestire errori e conferme
- Sanitizzare input utente

[Vai all'esercizio →](./esercizio-01/)

---

### Esercizio 2: Modifica ed Elimina Studente
**Difficoltà**: ⭐⭐⭐ Difficile

Crea un'interfaccia per modificare i dati di uno studente esistente ed eliminare studenti.

**Obiettivi**:
- Form precompilato con dati attuali
- Eseguire query UPDATE
- Implementare DELETE con conferma
- Usare prepared statements
- Gestire redirect dopo operazioni

[Vai all'esercizio →](./esercizio-02/)

---

## 💡 Suggerimenti

1. **Validazione**: Controlla SEMPRE i dati prima di inserirli nel database
2. **Prepared Statements**: Usa prepared statements per prevenire SQL injection
3. **Feedback utente**: Mostra sempre messaggi di conferma o errore
4. **Redirect**: Usa `header('Location: ...')` dopo operazioni di modifica
5. **Transazioni**: Per operazioni multiple, considera l'uso di transazioni

## 🔒 Sicurezza Importante

```php
// ❌ MAI fare così (SQL Injection vulnerability)
$query = "INSERT INTO studenti (nome) VALUES ('{$_POST['nome']}')";

// ✅ Usa prepared statements
$stmt = $pdo->prepare("INSERT INTO studenti (nome) VALUES (:nome)");
$stmt->execute(['nome' => $_POST['nome']]);
```

## 📖 Query SQL di Riferimento

### INSERT
```sql
INSERT INTO studenti (nome, cognome, email, citta) 
VALUES (?, ?, ?, ?);
```

### UPDATE
```sql
UPDATE studenti 
SET nome = ?, cognome = ?, email = ? 
WHERE id = ?;
```

### DELETE
```sql
DELETE FROM studenti WHERE id = ?;
```

## ✅ Checklist di Completamento

Dopo aver completato gli esercizi, dovresti essere in grado di:

- [ ] Creare form HTML per inserimento dati
- [ ] Validare input utente (campi obbligatori, email, ecc.)
- [ ] Eseguire query INSERT per aggiungere record
- [ ] Eseguire query UPDATE per modificare record
- [ ] Eseguire query DELETE per eliminare record
- [ ] Usare prepared statements per sicurezza
- [ ] Gestire errori e mostrare messaggi appropriati
- [ ] Implementare redirect dopo operazioni

## 🔗 Risorse Utili

- [PDO::prepare()](https://www.php.net/manual/it/pdo.prepare.php)
- [INSERT Statement](https://dev.mysql.com/doc/refman/8.0/en/insert.html)
- [UPDATE Statement](https://dev.mysql.com/doc/refman/8.0/en/update.html)
- [DELETE Statement](https://dev.mysql.com/doc/refman/8.0/en/delete.html)
- [PHP Form Handling](https://www.php.net/manual/it/tutorial.forms.php)

## 🚀 Prossimo Giorno

Nel **Giorno 3** approfondiremo la validazione avanzata, la gestione di file upload e le tecniche di sicurezza avanzate.
